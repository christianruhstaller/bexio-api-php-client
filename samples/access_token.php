<?php

/**
 * Simple API test with access token
 */

$accessToken = 'xxx'; // TODO: Enter your access token


use Bexio\Bexio;
use Bexio\Client;

require_once '../vendor/autoload.php';

$client = new Client();
$client->setAccessToken($accessToken);
$client->setJsonDecodeAssoc(true);

$client->onRequest(function (string $requestUrl, array $parameters) {
    echo sprintf('Requesting %s with %d parameters…' . PHP_EOL, $requestUrl, count($parameters));
});

$client->onResponse(function (string $requestUrl, string $response) {
    echo sprintf('Response of %s has %d bytes' . PHP_EOL, $requestUrl, strlen($response));
});

$bexio = new Bexio($client);

var_dump($bexio->getLanguages());
