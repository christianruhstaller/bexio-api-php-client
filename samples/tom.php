<?php

require_once '../vendor/autoload.php';

$clientId = '9999999999999.apps.bexio.com'; // The client id you have received from the bexio support
$clientSecret = 'W1diwrEvHlgQMPRYdr3t6I1z5sQ='; // The client secret you have received from the bexio support
$redirectUri = 'http://localhost/bexio-api-php-client.php'; // Set here your Url where this script gets called
$scope = 'general'; // A whitespace-separated list of scopes (see https://docs.bexio.com/oauth/scopes/).
$state = '8OTs2JTDcWDaPqV7o9aHVWqM'; // A random sequence. Should be used as a protection against CSRF-Attacks

$clientId = '6313765359.apps.bexio.com';
$clientSecret = 'QGITKza+ftg5QYm2nL6pTE7OOT4=';
$redirectUri = 'http://localhost:1337/bexio-api-php-client/samples/tom.php';

$credentialsFile = 'client_credentials.json';
$curl = new \Curl\Curl();

$client = new \Bexio\Client(
    [
        'clientId'     => $clientId,
        'clientSecret' => $clientSecret,
    ]
);
$client->setRedirectUri($redirectUri);

// If code is not set we need to get the authentication code
if (!isset($_GET['code'])) {
    $redirectTo = \Bexio\Client::OAUTH2_AUTH_URL.'?'.http_build_query(
            [
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri'  => $redirectUri,
                'scope'         => $scope,
                'state'         => $state,
            ]
        );

    header('Location: '.$redirectTo);
    exit;
} else {
    $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    file_put_contents($credentialsFile, json_encode($accessToken));
    exit;
}