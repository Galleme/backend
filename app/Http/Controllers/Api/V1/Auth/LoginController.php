<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $token = auth()->user()->createToken('galleme')->accessToken;

            return response()->json([
                'user' => auth()->user(),
                'token' => $token
            ], 200);
        }

        return response()->json([
            'error' => 'Incorrect email or password'
        ], 401);
    }
}
