<?php

namespace App\Exceptions;

use App\Constants\AppConstants;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;

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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if (is_api_request($request)){
            if ($exception instanceof AuthenticationException) {
                return $this->responseUnAuthorize($exception->getMessage());
            } elseif ($exception instanceof \Swift_TransportException) {
                return $this->responseServerError("E-mail couldn't be sent due to authorization error. Please check smtp configuration", AppConstants::ERR_MAIL_SERVER_AUTH_OR_CONF);
            } elseif ($exception instanceof ValidationException) {
                return $this->responseValidationError($exception->errors());
            } elseif ($exception instanceof HttpException) {
                return $this->apiResponse(null, $exception->getStatusCode(), $exception->getMessage(), $exception->getStatusCode());
            } elseif ($exception instanceof ModelNotFoundException) {
                return $this->responseNotFound();
            } elseif ($exception instanceof QueryException) {
                $codeText = '';
                if (config('app.debug'))
                    $codeText = $exception->getMessage();
                return $this->apiResponse(null, $exception->getCode(), $codeText, AppConstants::ERR_INTERNAL_SERVER_ERROR);
            }

            return $this->responseError($exception, $exception->getCode() );
        }
        return parent::render($request, $exception);
    }
}
