<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SendEmailLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PostmanTokenController;

// auth routes
Route::post('login', LoginController::class);
Route::post('password/email',  SendEmailLinkController::class);
Route::post('password/reset', NewPasswordController::class);
// only for postman 
Route::get('get-postman-token', PostmanTokenController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', ProfileController::class);
    Route::post('logout', LogoutController::class);

    // start from here
});
