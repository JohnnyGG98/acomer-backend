<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\QueryException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 404,
                'mensaje' => __('messages.objectnotfound'),
                'exception' => $exception->getMessage()
            ], 404);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'status' => 403,
                'mensaje' => __('messages.unauthorized'),
                'exception' => $exception->getMessage()
            ], 403);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'status' => 404,
                'mensaje' => __('messages.notfound'),
                'exception' => $exception->getMessage()
            ], 404);
        }

        if ($exception instanceof QueryException) {
            return response()->json([
                'status' => 400,
                'mensaje' => __('messages.invalidIDParameter'),
                'exception' => $exception->getMessage()
            ], 400);
        }

        if ($exception instanceof MethodNotAllowedHttpException){
            return response()->json([
                'status' => 404,
                'mensaje' => __('messages.methodNotFound'),
                'exception' => $exception->getMessage()
            ], 404);
        }

        return parent::render($request, $exception);
    }
}
