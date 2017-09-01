<?php

namespace Samples;

use Curl\Curl;

require_once '../vendor/autoload.php';

//$client = new \Bexio\Client([
//    'clientId' => '6313765359.apps.bexio.com',
//    'clientSecret' => 'QGITKza+ftg5QYm2nL6pTE7OOT4=',
//]);
//
//// Load previously authorized credentials from a file.
//$credentialsPath = 'client_credentials.json';
//
//if (file_exists($credentialsPath)) {
//    $accessToken = file_get_contents($credentialsPath);
//    $client->setAccessToken($accessToken);
//
//    if ($client->isAccessTokenExpired()) {
//        $client->refreshToken($client->getRefreshToken());
//        file_put_contents($credentialsPath, $client->getAccessToken());
//    }
//
//    var_dump($client->get('contact', []));
//} else {
//    throw new \Exception('No credentials found');
//}
//
//
//die();



$curl = new Curl();

$curl->post(
    'https://office.bexio.com/oauth/access_token',
    [
        'client_id'     => '6313765359.apps.bexio.com',
        'client_secret' => 'QGITKza+ftg5QYm2nL6pTE7OOT4=',
        'redirect_uri'  => 'http://testlink.ch/_bexio/test.php',
        'code'          => $_GET['code'],
    ]
);

echo $curl->response;
