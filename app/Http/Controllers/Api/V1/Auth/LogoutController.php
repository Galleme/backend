<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->token()->revoke();

            event(new Logout('api', $user));

            return response()->json([
                'message' => 'Logged out!',
            ]);
         }

         return response()->json([
            'message' => 'Not Logged In!',
        ], 401);
    }
}
