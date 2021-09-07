<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Email or Password not filled in',
                'fields' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('gallemeToken');
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(2);
                $token->save();
            }            

            event(new Login('api', $user, $request->remember_me));
            
            return response()->json([
                'user' => $user,
                'message' => 'Logged in',
                'token' => $tokenResult->accessToken,
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            ], 200);
        }

        return response()->json([
            'message' => 'Incorrect email or password',
        ], 401);
    }
}