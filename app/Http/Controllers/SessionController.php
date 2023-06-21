<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function Login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Invalid username or password!']
            ], 404);
        }
    
        $token = $user->createToken('my-app-token')->plainTextToken;
    
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    function Logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message' => ['Logout Successfully!']
        ]);
    }

}
