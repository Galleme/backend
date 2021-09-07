<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();

            return response()->json([
                'message' => 'Logged out!',
            ]);
         }

         return response()->json([
            'message' => 'Not Logged In!',
        ], 401);
    }
}
