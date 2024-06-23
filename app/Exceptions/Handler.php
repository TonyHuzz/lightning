<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Inertia\Inertia;
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

    public function render($request, Throwable $e): JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        $response = parent::render($request, $e);
        $status = $response->getStatusCode();

        $errorCode = [
            401 => 'Unauthorized',
            403 => $e->getMessage() ?: 'Forbidden',
            404 => 'Not Found',
            419 => 'Page Expired',
            429 => 'Too Many Requests',
            500 => 'Server Error',
            503 => $e->getMessage() ?: 'Service Unavailable',
        ];

        if (app()->isProduction() && in_array($status, array_keys($errorCode))) {
            return Inertia::render('Error', [
                'code' => $status,
                'message' => __($errorCode[$status]),
            ])
                ->toResponse($request)
                ->setStatusCode($status);
        }

        return $response;
    }
}
