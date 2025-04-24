<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
public function render($request, Throwable $exception)
{

    if ($exception instanceof ValidationException) {
        return response()->json(['message' => $exception->validator->errors()->messages()], 422);
    }
    if ($exception instanceof AuthenticationException) {
        // Nếu là request API, trả JSON
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        session()->flash('error', 'Bạn cần đăng nhập để tiếp tục.');
        return redirect()->guest(route('login'));
    }

    return parent::render($request, $exception);
}
}

