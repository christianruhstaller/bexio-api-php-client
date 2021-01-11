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

$bexio = new Bexio($client);

var_dump($bexio->getLanguages());
