<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constants\AppConstants;
use App\Entities\User;
use App\Traits\ApiResponser;
use Defuse\Crypto\Crypto;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class ApiLoginController extends AccessTokenController
{

    use ApiResponser;

    const GRANT_TYPE_PASSWORD = 'password';

    const GRANT_TYPE_REFRESH_TOKEN = 'refresh_token';

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return mixed
     */
    public function authenticate(ServerRequestInterface $request)
    {
        $validator = Validator::make($request->getParsedBody() , [
            'username'    => 'required|email' ,
            'password' => 'required|string' ,
        ]);
        if ($validator->fails()){
            return $this->responseValidationError($validator->messages());
        }

        $request = $request->withParsedBody(array_merge($request->getParsedBody() , $this->getAuthParamsForClient(static::GRANT_TYPE_PASSWORD)));

        $response = $this->issueToken($request);

        return $this->parseResultForResponse($response);
    }

    /**
     * @param $grantType
     *
     * @return array
     */
    protected function getAuthParamsForClient($grantType)
    {
        return [
            'grant_type'    => $grantType ,
            'client_id'     => env('OAUTH_CLIENT_ID') ,
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
        ];
    }


    /**
     * @param Response $response
     *
     * @return mixed
     */
    protected function parseResultForResponse(Response $response)
    {
        if ($response->getStatusCode() == 401){
            //invalid username password issue
            $message = json_decode($response->getContent());
            if ($message->error == AppConstants::ERR_INVALID_CREDENTIAL){
                return $this->responseUnAuthorize($message->message , $message->error);
            }
            else{
                return $this->responseBadRequest($message->message , $message->error);
            }
        }
        elseif ($response->getStatusCode() == 200){
            $user = $this->getUserFromResponse($response);
            /** create an event  */

            $content = json_decode($response->getContent());
            return $this->responseOk($user , 'ok' , 'ok' , [
                'Access-Token'  => $content->access_token ,
                'Refresh-Token' => $content->refresh_token ,
                'Token-Type'    => $content->token_type ,
                'Expires-In'    => $content->expires_in ,
            ]);
        }

        return $this->responseServerError($response->getContent());
    }

    public function getUserFromResponse(Response $response)
    {
        $content = json_decode($response->getContent());
        $parser  = $this->jwt->parse($content->access_token);
        $userId  = $parser->getClaim('sub');

        $user = User::find($userId);
        return $user;

    }

    /**
     * Refresh the token
     *
     * @param ServerRequestInterface $request
     *
     * @return mixed
     * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
     * @throws \Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException
     */
    public function refreshToken(ServerRequestInterface $request)
    {
        $rule = ['refresh_token' => 'required'];

        $validator = Validator::make($request->getParsedBody() , $rule);
        if ($validator->fails()){
            return $this->responseValidationError($validator->messages() , 'Refresh token is required' , AppConstants::ERR_FORM_VALIDATION);
        }
        $request  = $request->withParsedBody(array_merge($request->getParsedBody() , $this->getAuthParamsForClient(static::GRANT_TYPE_REFRESH_TOKEN)));
        $response = $this->issueToken($request);
        if ($response->getStatusCode() == 401){
            $encryptedRefreshToken = $this->getRequestParameter('refresh_token' , $request);
            $refreshToken          = Crypto::decryptWithPassword($encryptedRefreshToken , app('encrypter')->getKey());
            $refreshTokenData      = json_decode($refreshToken , TRUE);
            $refreshTokenTableData = DB::table('oauth_refresh_tokens')
                ->where('id' , $refreshTokenData['refresh_token_id'])
                ->first();
        }

        return $this->parseResultForResponse($response);
    }

    protected function getRequestParameter($parameter , ServerRequestInterface $request , $default = NULL)
    {
        $requestParameters = (array) $request->getParsedBody();
        return isset($requestParameters[$parameter]) ? $requestParameters[$parameter] : $default;
    }
}
