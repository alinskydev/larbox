<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\QueryException;
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

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'message' => $exception->getMessage(),
            'errors' => Arr::undot($exception->errors()),
        ], $exception->status);
    }

    public function render($request, Throwable $e)
    {
        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        switch (get_class($e)) {
            case NotFoundHttpException::class:
                $response = [
                    'status' => 404,
                    'data' => ['message' => 'Not found'],
                ];
                break;

            case TypeError::class:
            case QueryException::class:
                $response = [
                    'status' => 403,
                    'data' => ['message' => 'Invalid input data type'],
                ];
                break;

            case ValidationException::class:
                return $this->invalidJson($request, $e);

            default:
                $response = [
                    'status' => method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
                    'data' => ['message' => $e->getMessage() ?: 'An unhandled exception'],
                ];
        }

        return response()->json($response['data'], $response['status']);
    }

    public function handleExceptions($e)
    {
        if ($e instanceof ValidationException) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }

        return response()->view('errors.500', [], 500);
    }
}
