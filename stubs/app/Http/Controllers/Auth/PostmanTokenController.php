<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;

class PostmanTokenController extends Controller
{
    public function __invoke()
    {
        $user = User::first();

        return json_response(
            data: ['token' => $user->createToken('postman')->plainTextToken]
        );
    }
}
