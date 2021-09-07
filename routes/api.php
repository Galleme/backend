<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\PasswordController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->name('v1.')->group(function() {
    Route::prefix('auth')->name('auth.')->group(function() {
        Route::post('register', [RegisterController::class, 'register'])->name('register');
        Route::post('login', [LoginController::class, 'login'])->name('login');
        Route::post('password/forgot', [PasswordController::class, 'forgot'])->name('password.forgot');
        Route::post('password/reset', [PasswordController::class, 'reset'])->name('password.reset');

        Route::middleware('auth:api')->group(function () {
            Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
        });
    });

    Route::get('healthcheck', function () {
        return response()->json([
            'status' => 'online',
        ], 200);
    });
});
