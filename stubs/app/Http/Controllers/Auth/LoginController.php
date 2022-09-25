<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return json_response(
                data: new UserResource(user())
            );
        }

        return json_response(
            status: StatusCode::HTTP_UNPROCESSABLE_ENTITY,
            errors: trans('site.login_failed'),
        );
    }
}
