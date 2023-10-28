<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        // create code to return bearer token in response passport login token


        $credentials = $loginRequest->only('email', 'password');
        if ( !auth()->attempt($credentials) ) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;
        
        return response()->json([
            'token' => $token,
            'user'  => auth()->user(),
        ], 200);
    }
}
