<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ForbiddenHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServerErrorHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Menangani error 400 (Bad Request)
        if ($exception instanceof BadRequestHttpException) {
            return response()->view('errors.400', [], 400);
        }

        // Menangani error 403 (Forbidden)
        if ($exception instanceof ForbiddenHttpException) {
            return response()->view('errors.403', [], 403);
        }

        // Menangani error 404 (Not Found)
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Menangani error 419 (Page Expired)
        if ($exception instanceof TokenMismatchException) {
            return response()->view('errors.419', [], 419);
        }

        // Menangani error 500 (Internal Server Error)
        if ($exception instanceof HttpException && $exception->getStatusCode() == 500) {
            return response()->view('errors.500', [], 500);
        }

        return parent::render($request, $exception);
    }
}
