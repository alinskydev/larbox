<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use TypeError;
use Throwable;

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
     * A list of the inputs that are never flashed for validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $e)
    {
        Log::error($e->getMessage(), ['exception' => $e]);
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, $e)
    {
        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        switch (get_class($e)) {
            case AuthenticationException::class:
                return response()->json(['message' => 'Unauthenticated'], 401);

            case NotFoundHttpException::class:
            case ModelNotFoundException::class:
                return response()->json(['message' => 'Not found'], 404);

            case TypeError::class:
            case QueryException::class:
                return response()->json(['message' => 'Invalid input data type'], 400);

            case ValidationException::class:
                return $this->invalidJson($request, $e);

            case ThrottleRequestsException::class:
                /** @var ThrottleRequestsException $e */
                return response()->json(
                    [
                        'message' => $e->getMessage(),
                        'seconds_left' => Arr::get($e->getHeaders(), 'Retry-After', 0),
                    ],
                    $e->getStatusCode(),
                );

            default:
                $defaultStatus = app()->environment('testing') ? 400 : 500;

                return response()->json(
                    [
                        'message' => $e->getMessage() ?: 'An error occurred',
                    ],
                    method_exists($e, 'getStatusCode') ? $e->getStatusCode() : $defaultStatus,
                );
        }
    }

    /**
     * @param Throwable $e
     * @return Response
     */
    public function handleExceptions($e)
    {
        if ($e instanceof ValidationException) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }

        return response()->view('errors.500', [], 500);
    }
}
