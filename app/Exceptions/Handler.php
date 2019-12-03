<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * {@inheritdoc}
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ValidationException) {
            return $this->prepareJsonResponse($request, $e);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->prepareJsonResponse($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * {@inheritdoc}
     */
    protected function prepareJsonResponse($request, Exception $e)
    {
        $isHttp = $this->isHttpException($e);

        if ($e instanceof ValidationException) {
            return Controller::respondWithError([
                'message' => $e->getMessage(),
                'details' => $e->errors()
            ]);
        }

        return Controller::respondWithError(
            $this->convertExceptionToArray($e),
            $isHttp ? $e->getStatusCode() : 500,
            $isHttp ? $e->getHeaders() : []
        );
    }
}
