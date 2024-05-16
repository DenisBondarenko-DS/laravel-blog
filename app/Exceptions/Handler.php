<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {
            if ($e instanceof ModelNotFoundException) {
                //return responseFailed(getMessage('model_not_found'), 404);
                return responseFailed(getModelNotFoundMessage($e->getModel()), 404);
            }

            $this->renderable(function (NotFoundHttpException $e) {
                return responseFailed(getMessage('route_not_found'), 404);
                //return responseFailed($e->getMessage(), 404);
            });

            $this->renderable(function (AuthenticationException $e) {
                return responseFailed(getMessage('auth_error'), 401);
            });
        }

        return parent::render($request, $e);
    }
}
