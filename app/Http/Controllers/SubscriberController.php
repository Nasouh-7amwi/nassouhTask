<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use function PHPUnit\Framework\isEmpty;

class SubscriberController extends Controller
{
    public function index()
    {
        $Subscribers = Subscriber::all();

        return response()->json([
            'Message' => 'All Subscribers',
            'Subscribers' => $Subscribers
        ], 200);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'userName' => 'required|email|min:3|unique:subscribers',
            'password' => 'required|min:8'
        ]);

        $subscriber = Subscriber::create($request->all());

        return response()->json([
            'Message' => 'Subscriber was created successfully',
            'Subscriber' => $subscriber
        ], 200);

    }

    public function show($subscriber_id)
    {
        $Subscriber = Subscriber::query()->find($subscriber_id);

        if (!$Subscriber) {
            return response()->json([
                'Message' => 'Subscriber dose not exist'
            ]);
        }

        return response()->json([
            'Subscriber' => $Subscriber
        ], 200);

    }

    public function update(Request $request, $subscriber_id)
    {
        $Subscriber = Subscriber::query()->find($subscriber_id);

        if (!$Subscriber) {
            return response()->json([
                'Message' => 'Subscriber dose not exist'
            ]);
        }

        if ($request->name) {
            $request->validate([
                'name' => 'string|min:3',
            ]);
            $Subscriber->name = $request->name;
        }
        if ($request->userName) {
            $request->validate([
                'userName' => 'email|min:3|unique:subscribers',
            ]);
            $Subscriber->userName = $request->userName;
        }
        if ($request->password) {
            $request->validate([
                'password' => 'min:8'
            ]);
            $Subscriber->password = $request->password;
        }
        $Subscriber->save();

        return response()->json([
            'Message' => 'Subscriber was updated successfully',
            'Subscriber' => $Subscriber
        ], 200);

    }

    public function destroy($subscriber_id)
    {
        $Subscriber = Subscriber::query()->find($subscriber_id);

        if (!$Subscriber) {
            return response()->json([
                'Message' => 'Subscriber dose not exist'
            ]);
        }

        $Subscriber->delete();

        return response()->json([
            'Message' => 'Subscriber was deleted successfully'
        ], 200);
    }

    public function subscribed($subscriber_id)
    {
        $Subscriber = Subscriber::query()->find($subscriber_id);

        if (!$Subscriber) {
            return response()->json([
                'Message' => 'Subscriber dose not exist'
            ]);
        }

        $Subscriber->subscribed=true;
        $Subscriber->save();

        return redirect('/home2');

        return response()->json([
            'Message' => 'Subscriber was subscribed successfully'
        ], 200);
    }

    public function search(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $Subscriber = Subscriber::query()->where('name', 'like', '%' . $request->name . '%')->get();

        return response()->json([
            'Message' => 'All Subscribers that have the same name',
            'Subscribers' => $Subscriber
        ], 200);
    }
}
