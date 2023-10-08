<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Image;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $Blogs = Blog::with(['img','subscriber'])->get();
        $subscribers = Subscriber::get();

        $Blogs = $Blogs->map(function ($item) {
            $item->publishDate = $item->created_at->format('Y-m-d');
            unset($item->created_at);
            return $item;
        });

        $subscribers = $subscribers->map(function ($item) {
            $item->joinDate = $item->created_at->format('Y');
            unset($item->created_at);
            return $item;
        });

        return view('home2',['blogs'=>$Blogs, 'subscribers'=>$subscribers]);

    }

    public function indexApi()
    {
        $Blogs = Blog::with(['img','subscriber'])->get();

        $Blogs = $Blogs->map(function ($item) {
            $item->publishDate = $item->created_at->format('Y-m-d');
            unset($item->created_at);
            return $item;
        });

        return response()->json([
            'Message' => 'All Blogs',
            'Blogs' => $Blogs
        ], 200);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'conten' => 'required|string',
            'image' => 'required|image'
        ]);

        $Blog = Blog::create([
           'title'=>$request->title,
           'content' => $request->conten,
            'subscriber_id'=>auth()->id()
        ]);

        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'images/blogs';
        $request->image->move($path, $file_name);
        $img = new Image([
            'path' => 'http://127.0.0.1:8000/' . $path . '/' . $file_name,
        ]);
        $Blog->img()->save($img);

        return response()->json([
            'Message' => 'Blog was created successfully',
            'Blog' => $Blog
        ], 200);

    }

    public function show($Blog_id)
    {
        $Blog = Blog::query()->with('img')->find($Blog_id);

        if (!$Blog) {
            return response()->json([
                'Message' => 'Blog dose not exist'
            ]);
        }

        return response()->json([
            'Blog' => $Blog
        ], 200);

    }

    public function update(Request $request, $Blog_id)
    {
        $Blog = Blog::query()->find($Blog_id);

        if (!$Blog) {
            return response()->json([
                'Message' => 'Blog dose not exist'
            ]);
        }

        $request->validate([
            'title' => 'string|min:5',
            'content' => 'string|min:5',
        ]);

        $Blog->update($request->all());

        if($request->image){
            $Blog->img->delete();
            $file_extension = $request->image->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images/blogs';
            $request->image->move($path, $file_name);
            $img = new Image([
                'path' => 'http://127.0.0.1:8000/' . $path . '/' . $file_name,
            ]);
            $Blog->img()->save($img);
        }

        return response()->json([
            'Message' => 'Blog was updated successfully',
            'Blog' => $Blog
        ], 200);

    }

    public function destroy($Blog_id)
    {
        $Blog = Blog::query()->find($Blog_id);

        if (!$Blog) {
            return response()->json([
                'Message' => 'Blog dose not exist'
            ]);
        }

        $Blog->delete();

        return response()->json([
            'Message' => 'Blog was deleted successfully'
        ], 200);
    }

    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $Blog = Blog::query()->where('title', 'like', '%' . $request->title . '%')->get();

        return response()->json([
            'Message' => 'All Blogs that have the same title',
            'Blogs' => $Blog
        ], 200);
    }
}
