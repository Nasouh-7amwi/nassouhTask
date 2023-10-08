<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){


        $request->validate([
            'userName' => 'required|email',
            'password' => 'required',
        ]);

        $user = Subscriber::where('userName', $request->userName)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'Message' => 'The provided credentials are incorrect.'
            ]);
        }

        $token =  $user->createToken($request->userName)->plainTextToken;

        return response()->json([
            'Subscriber' => $user,
            'token' => $token
        ]);
    }
}
