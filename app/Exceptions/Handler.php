<?php

namespace App\Exceptions;

use Exception;
use HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    private $handledStatusCodes = [403, 404];
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson()) {
            $exception = $this->prepareException($exception);
            if ($exception instanceof NotFoundHttpException
                or
                $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                or
                $exception instanceof HttpException
                or
                $exception instanceof ModelNotFoundException
                or
                $exception instanceof HttpResponseException) {
                return response()->json([
                    'errorMessage' => $exception->getMessage(),
                ], $exception->getStatusCode());
            }
            if ($exception instanceof AuthenticationException
                or
                $exception instanceof ValidationException) {
                return parent::render($request, $exception);
            }

            if (!env('APP_DEBUG')){
                return response()->json([
                    'errorMessage' => 'Sorry, something went wrong',
                ], 500);
            }

            return response()->json([
                'errorMessage' => $exception->getMessage(),
                'errorClass'   => get_class($exception),
                'file'         => $exception->getFile(),
                'line'         => $exception->getLine()
            ], 500);
        }
        else {
            if(((!method_exists($exception, 'getStatusCode') ||
                        !in_array($exception->getStatusCode(), $this->handledStatusCodes))
                    && !($exception instanceof AuthenticationException))
                && !env('APP_DEBUG')) {
                return view('errors.500');
            }

            return parent::render($request, $exception);
        }
    }

    /**.
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['errorMessage' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
