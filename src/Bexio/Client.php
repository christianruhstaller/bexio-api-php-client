<?php

namespace Bexio;

use Bexio\Auth\OAuth2;
use Curl\Curl;

class Client
{
    const API_URL = 'https://api.bexio.com/2.0';
    const OAUTH2_AUTH_URL = 'https://idp.bexio.com/authorize';
    const OAUTH2_TOKEN_URI = 'https://idp.bexio.com/token';
    const OAUTH2_REFRESH_TOKEN_URI = 'https://idp.bexio.com/token';

    /**
     * @var array $config
     */
    private $config;

    /**
     * @var
     */
    private $accessToken;

    /**
     * @var
     */
    private $auth;

    private $jsonDecodeAssoc = false;

    private $requestCallbacks = [];
    private $responseCallbacks = [];

    /**
     * Client constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $this->config = array_merge(
            [
                'clientId'     => '',
                'clientSecret' => '',
                'redirectUri'  => null,
            ],
            $config
        );
    }

    public function setClientId($clientId)
    {
        $this->config['clientId'] = $clientId;
    }

    public function getClientId()
    {
        return $this->config['clientId'];
    }

    public function setClientSecret($clientId)
    {
        $this->config['clientSecret'] = $clientId;
    }

    public function getClientSecret()
    {
        return $this->config['clientSecret'];
    }

    public function setRedirectUri($redirectUri)
    {
        $this->config['redirectUri'] = $redirectUri;
    }

    public function getRedirectUri()
    {
        return $this->config['redirectUri'];
    }

    /**
     * @param $accessToken
     * @throws \Exception
     */
    public function setAccessToken($accessToken)
    {
        if (is_string($accessToken)) {
            if ($json = json_decode($accessToken, true)) {
                $accessToken = $json;
            } else {
                $accessToken = [
                    'access_token' => $accessToken,
                ];
            }
        }

        if ($accessToken == null) {
            throw new \Exception('Invalid json token');
        }

        if (!isset($accessToken['access_token'])) {
            throw new \Exception("Invalid token format");
        }
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function isAccessTokenExpired()
    {
        if (!$this->accessToken) {
            return true;
        }

        $created = 0;
        $expiresIn = 0;

        if (isset($this->accessToken['created'])) {
            $created = $this->accessToken['created'];
        }

        if (isset($this->accessToken['expires_in'])) {
            $expiresIn = $this->accessToken['expires_in'];
        }

        return ($created + ($expiresIn - 30)) < time();
    }

    public function getRefreshToken()
    {
        if (isset($this->accessToken['refresh_token'])) {
            return $this->accessToken['refresh_token'];
        }

        return null;
    }

    public function fetchAuthCode()
    {
        $auth = $this->getOAuth2Service();
        $auth->setRedirectUri($this->getRedirectUri());


    }

    public function fetchAccessTokenWithAuthCode($code)
    {
        if (strlen($code) === 0) {
            throw new \Exception("Invalid code");
        }

        $auth = $this->getOAuth2Service();
        $auth->setCode($code);
        $auth->setRedirectUri($this->getRedirectUri());

        $credentials = $auth->fetchAuthToken();

        if ($credentials && isset($credentials['access_token'])) {
            $credentials['created'] = time();
            $this->setAccessToken($credentials);
        }

        return $credentials;
    }

    public function refreshToken($refreshToken = null)
    {
        if ($refreshToken === null) {
            if (!isset($this->accessToken['refresh_token'])) {
                throw new \Exception('Refresh token must be passed or set as part of the accessToken');
            }

            $refreshToken = $this->accessToken['refresh_token'];
        }

        $auth = $this->getOAuth2Service();
        $auth->setRefreshToken($refreshToken);

        $credentials = $auth->fetchAuthToken();

        if ($credentials && isset($credentials['access_token'])) {
            $credentials['created'] = time();
            if (!isset($credentials['refresh_token'])) {
                $credentials['refresh_token'] = $refreshToken;
            }
            $this->setAccessToken($credentials);

            return $credentials;
        }

        throw new \Exception('Illegal access token received when token was refreshed');
    }

    /**
     * @return OAuth2
     */
    public function getOAuth2Service()
    {
        if (!isset($this->auth)) {
            $this->auth = new OAuth2(
                [
                    'clientId'                  => $this->getClientId(),
                    'clientSecret'              => $this->getClientSecret(),
                    'authorizationUri'          => self::OAUTH2_AUTH_URL,
                    'tokenCredentialUri'        => self::OAUTH2_TOKEN_URI,
                    'refreshTokenCredentialUri' => self::OAUTH2_REFRESH_TOKEN_URI,
                    'redirectUri'               => $this->getRedirectUri(),
                    'issuer'                    => $this->config['clientId'],
                ]
            );
        }

        return $this->auth;
    }

    protected function getRequest()
    {
        $accessToken = $this->getAccessToken();

        $curl = new Curl();
        $curl->setHeader('Accept', 'application/json');
        $curl->setHeader('Authorization', 'Bearer '.$accessToken['access_token']);

        return $curl;
    }

    public function get($path, array $parameters = [])
    {
        return $this->call($path, $parameters, function ($request, $url, $parameters) {
            $request->get($url, $parameters);
        });
    }

    public function post($path, array $parameters = [])
    {
        return $this->call($path, $parameters, function ($request, $url, $parameters) {
            $request->post($url, json_encode($parameters));
        });
    }

    public function postWithoutPayload($path)
    {
        return $this->call($path, [], function ($request, $url, $parameters) {
            $request->post($url);
        });
    }

    public function put($path, array $parameters = [])
    {
        return $this->call($path, $parameters, function ($request, $url, $parameters) {
            $request->put($url, $parameters);
        });
    }

    public function delete($path, array $parameters = [])
    {
        return $this->call($path, $parameters, function ($request, $url, $parameters) {
            $request->delete($url, $parameters);
        });
    }

    private function call($path, array $parameters = [], \Closure $callback)
    {
        $request = $this->getRequest();
        $url = self::API_URL . '/' . $path;

        $this->logRequest($url, $parameters);
        $callback($request, $url, $parameters);
        $this->logResponse($url, $request->response);

        if ($request->isError()) {
            throw new \Exception(sprintf('Error on HTTP request to %s: %s', $url, $request->response));
        }

        return json_decode($request->response, $this->jsonDecodeAssoc);
    }

    public function setJsonDecodeAssoc(bool $jsonDecodeAssoc): self
    {
        $this->jsonDecodeAssoc = $jsonDecodeAssoc;
        return $this;
    }

    public function onRequest(\Closure $callback)
    {
        $this->requestCallbacks[] = $callback;
    }

    public function onResponse(\Closure $callback)
    {
        $this->responseCallbacks[] = $callback;
    }

    private function logRequest(string $requestUrl, array $parameters = [])
    {
        foreach ($this->requestCallbacks as $callback) {
            $callback($requestUrl, $parameters);
        }
    }

    private function logResponse(string $requestUrl, string $response)
    {
        foreach ($this->responseCallbacks as $callback) {
            $callback($requestUrl, $response);
        }
    }
}
