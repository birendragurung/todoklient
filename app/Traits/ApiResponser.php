<?php


namespace App\Traits;


use Illuminate\Http\Response;

trait ApiResponser
{

    protected $api = TRUE;

    /**
     * @param int $code
     *
     * @return int
     */
    public function validateStatusCode($code = 0)
    {
        $status_code = [
            100 ,
            101 ,
            102 ,
            200 ,
            201 ,
            202 ,
            203 ,
            204 ,
            205 ,
            206 ,
            207 ,
            208 ,
            226 ,
            300 ,
            301 ,
            302 ,
            303 ,
            304 ,
            305 ,
            306 ,
            307 ,
            308 ,
            400 ,
            401 ,
            402 ,
            403 ,
            404 ,
            405 ,
            406 ,
            407 ,
            408 ,
            409 ,
            410 ,
            411 ,
            412 ,
            413 ,
            414 ,
            415 ,
            416 ,
            417 ,
            418 ,
            421 ,
            422 ,
            423 ,
            424 ,
            425 ,
            426 ,
            428 ,
            429 ,
            431 ,
            451 ,
            500 ,
            501 ,
            502 ,
            503 ,
            504 ,
            505 ,
            506 ,
            507 ,
            508 ,
            510 ,
            511,
        ];
        if (in_array($code , $status_code)){
            return $code;
        }
        else{
            return 500;
        }
    }

    /**
     * @param $body
     *
     * @return mixed
     */
    protected function parseBodyForList($body)
    {

        if ($body instanceof Collection || (is_array($body) && !array_is_assoc($body))){
            return ['data' => $body];
        }
        return $body;
    }

    /**
     * @param $body
     * @param int $status
     * @param string $codeText
     * @param string $messageCode
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiResponse($body , $status = Response::HTTP_OK , $codeText = 'OK' , $messageCode = 'ok' , $headers = [])
    {
        $status       = $this->validateStatusCode($status);
        $body         = $this->parseBodyForList($body);
        $responseJson = [
            'body'   => $body ,
            'status' => [
                "message"            => $messageCode ,
                'code'               => $messageCode ,
                'code_text'          => $codeText ,
                'response_timestamp' => date('Y-m-d\TH:i:sP' , time()),
            ] ,
        ];
        if (\Debugbar::isEnabled()){
            $responseJson['_debugbar'] = app('debugbar')->getData();
        }
        return response()->json($responseJson , $status)->withHeaders($headers);
    }

    /**
     * @param $body
     * @param string $codeText
     * @param string $messageCode
     * @param array $headers
     *
     * @return mixed
     */
    public function responseOk($body , $codeText = 'ok' , $messageCode = 'ok' , $headers = [])
    {
        return $this->apiResponse($body , Response::HTTP_OK , $codeText , $messageCode , $headers);
    }

    /**
     * @param $body
     * @param int $status
     * @param string $codeText
     * @param string $messageCode
     * @param array $headers
     *
     * @return mixed
     */
    public function responseError($body , $status = Response::HTTP_INTERNAL_SERVER_ERROR , $codeText = 'server error' , $messageCode = 'server_error' , $headers = [])
    {
        return $this->apiResponse($body , $status , $codeText , $messageCode , $headers);
    }

    /**
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responseServerError($codeText = 'internal server error occured' , $code = 'internal_server_error' , $headers = [])
    {
        return $this->responseError(NULL , Response::HTTP_INTERNAL_SERVER_ERROR , $codeText , $code);
    }

    /**
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responseUnAuthorize($codeText = 'unauthorized' , $code = 'unauthorized' , $headers = [])
    {
        return $this->responseError(NULL , Response::HTTP_UNAUTHORIZED , $codeText , $code , $headers);
    }

    /**
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responseForbidden($codeText = 'forbidden' , $code = 'forbidden' , $headers = [])
    {
        return $this->responseError(NULL , Response::HTTP_FORBIDDEN , $codeText , $code , $headers);
    }

    /**
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responseNotFound($codeText = 'not found' , $code = 'not_found' , $headers = [])
    {
        return $this->responseError(NULL , Response::HTTP_NOT_FOUND , $codeText , $code , $headers);
    }

    /**
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responseBadRequest($codeText = 'bad request' , $code = 'bad_request' , $headers = [])
    {
        return $this->responseError(NULL , Response::HTTP_BAD_REQUEST , $codeText , $code , $headers);
    }

    /**
     * @param string $body
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responsePreConditionFailed($body = '' , $codeText = 'precondition failed' , $code = 'precondition_failed' , $headers = [])
    {
        return $this->responseError($body , Response::HTTP_PRECONDITION_FAILED , $codeText , $code , $headers);
    }

    /**
     * @param null $body
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responseConflict($body = NULL , $codeText = 'conflict' , $code = 'conflict' , $headers = [])
    {
        return $this->responseError($body , Response::HTTP_CONFLICT , $codeText , $code , $headers);
    }

    /**
     * @param null $body
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responseExpectationFailed($body = NULL , $codeText = 'expectation failed' , $code = 'expectation_failed' , $headers = [])
    {
        return $this->responseError($body , Response::HTTP_EXPECTATION_FAILED , $codeText , $code , $headers);
    }

    /**
     * @param null $body
     * @param string $codeText
     * @param string $code
     * @param array $headers
     *
     * @return mixed
     */
    public function responseValidationError($body = NULL , $codeText = 'form validation failed' , $code = 'form_validation_error' , $headers = [])
    {
        return $this->responseError($body , Response::HTTP_EXPECTATION_FAILED , $codeText , $code , $headers);
    }
}
