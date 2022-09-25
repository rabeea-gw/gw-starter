<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Auth\SendPasswordEmailRequest;

class SendEmailLinkController extends Controller
{
    public function __invoke(SendPasswordEmailRequest $request)
    {
        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
            ? json_response(message: trans('passwords.sent'))
            : json_response(errors: trans('passwords.failed'));
    }
}
