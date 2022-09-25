<?php

namespace App\Exceptions;

use Throwable;
use App\Helpers\StatusCode;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return json_response(
                    status: StatusCode::HTTP_UNAUTHORIZED,
                    message: trans('site.unauthenticated'),
                );
            }
        });

        $this->renderable(function (ThrottleRequestsException $exception, $request) {
            if ($request->is('api/*')) {
                return json_response(
                    status: StatusCode::HTTP_TOO_MANY_REQUESTS,
                    message: trans('passwords.throttled'),
                );
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return json_response(
                    status: StatusCode::HTTP_NOT_FOUND,
                    message: trans('site.not_found'),
                );
            }
        });

        $this->renderable(function (AccessDeniedHttpException $exception, $request) {
            if ($request->is('api/*')) {
                return json_response(
                    status: StatusCode::HTTP_FORBIDDEN,
                    message: $exception->getMessage(),
                );
            }
        });

        $this->renderable(function (ValidationException $exception, $request) {
            if ($request->is('api/*')) {
                return json_response(
                    status: $exception->status,
                    message: 'The given data was invalid.',
                    errors: $exception->errors()
                );
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $exception, $request) {
            if ($request->is('api/*')) {
                return json_response(
                    status: StatusCode::HTTP_METHOD_NOT_ALLOWED,
                    message: $exception->getMessage(),
                );
            }
        });
    }
}
