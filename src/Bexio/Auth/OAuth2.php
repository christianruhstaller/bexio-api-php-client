<?php

namespace Bexio\Auth;

use Curl\Curl;

class OAuth2
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var
     */
    private $grantType;

    public function __construct(array $config = array())
    {
        $this->config = array_merge(
            [
                'clientId'                  => null,
                'clientSecret'              => null,
                'authorizationUri'          => null,
                'refreshTokenCredentialUri' => null,
                'redirectUri'               => null,
                'issuer'                    => null,
                'code'                      => null,
                'refreshToken'              => null,
                'username'                  => null,
                'password'                  => null,
            ],
            $config
        );
    }

    public function setRefreshToken($refreshToken)
    {
        $this->config['refreshToken'] = $refreshToken;
    }

    public function getRefreshToken()
    {
        return $this->config['refreshToken'];
    }

    public function getClientId()
    {
        return $this->config['clientId'];
    }

    public function setClientId($clientId)
    {
        $this->config['clientId'] = $clientId;
    }

    public function getClientSecret()
    {
        return $this->config['clientSecret'];
    }

    public function setClientSecret($clientSecret)
    {
        $this->config['clientSecret'] = $clientSecret;
    }

    public function getCode()
    {
        return $this->config['code'];
    }

    public function setCode($code)
    {
        $this->config['code'] = $code;
    }

    public function getRedirectUri()
    {
        return $this->config['redirectUri'];
    }

    public function setRedirectUri($redirectUri)
    {
        $this->config['redirectUri'] = $redirectUri;
    }

    public function getGrantType()
    {
        if (!is_null($this->grantType)) {
            return $this->grantType;
        }

        if (!is_null($this->config['code'])) {
            return 'authorization_code';
        } elseif (!is_null($this->config['refreshToken'])) {
            return 'refresh_token';
        } elseif (!is_null($this->config['username']) && !is_null($this->config['password'])) {
            return 'password';
        } else {
            return null;
        }
    }

    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;
    }

    public function fetchAuthToken()
    {
        $response = $this->generateCredentialsRequest();
        $credentials = $this->parseTokenResponse($response);

        return $credentials;
    }

    public function generateCredentialsRequest()
    {
        $uri = $this->getRefreshTokenCredentialUri();

        $grantType = $this->getGrantType();

        $params = [
            'grant_type' => $grantType,
        ];

        switch ($grantType) {
            case 'authorization_code':
                $params['code'] = $this->getCode();
                $params['redirect_uri'] = $this->getRedirectUri();
                $this->addClientCredentials($params);
                break;
            case 'refresh_token':
                $params['refresh_token'] = $this->getRefreshToken();
                $this->addClientCredentials($params);
                break;
            default:
                break;
        }

        $curl = new Curl();
        $curl->setHeader('Cache-Control', 'no-store');
        $curl->setHeader('Content-Type', 'application/x-www-form-urlencoded');

        $curl->post($uri, $params);

        return $curl;
    }

    public function getRefreshTokenCredentialUri()
    {
        return $this->config['refreshTokenCredentialUri'];
    }

    public function parseTokenResponse(Curl $response)
    {
        $body = (string)$response->response;
        $res = json_decode($body, true);

        if ($res === null || !$res) {
            throw new \Exception('Invalid JSON response');
        }

        if($res['error']) {
            throw new \Exception('OAuth error: '.$res['error'].'. Message: '.$res['error_description']);
        }

        return $res;
    }

    private function addClientCredentials(&$params)
    {
        $params['client_id'] = $this->getClientId();
        $params['client_secret'] = $this->getClientSecret();

        return $params;
    }
}