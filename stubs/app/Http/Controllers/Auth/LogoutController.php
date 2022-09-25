<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        user()->tokens()->delete();

        return json_response(message: trans('site.logout_message'));
    }
}
