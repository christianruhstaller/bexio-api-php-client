# bexio API PHP Client

The bexio API Client Library enables you to work with the bexio API.
This is an early version and is still in development.

See the [bexio API documentation](https://docs.bexio.com) for more information how to use the API.

## Installation

You can use **Composer** or download the library.

Require this package with composer:

```sh
composer require christianruhstaller/bexio-api-php-client
```
Include the autoloader:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

## Examples
Get access token
```php
require_once '../vendor/autoload.php';

$clientId = '9999999999999.apps.bexio.com'; // The client id you have received from the bexio support
$clientSecret = 'W1diwrEvHlgQMPRYdr3t6I1z5sQ='; // The client secret you have received from the bexio support
$redirectUri = 'http://localhost/bexio-api-php-client.php'; // Set here your Url where this script gets called
$scope = 'general'; // A whitespace-separated list of scopes (see https://docs.bexio.com/oauth/scopes/).
$state = '8OTs2JTDcWDaPqV7o9aHVWqM'; // A random sequence. Should be used as a protection against CSRF-Attacks
$credentialsPath = 'client_credentials.json'; // Set the path where the credentials file will be stored

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
```

Init client 
```php
    require_once '../vendor/autoload.php';
    
    $client = new \Bexio\Client([
        'clientId' => 'CLIENT_ID',
        'clientSecret' => 'CLIENT_SECRET',
    ]);
    
    $credentialsPath = 'PATH_TO_CREDENTIAL_FILE';
    
    if (!file_exists($credentialsPath)) {
        throw new \Exception('Credentials file not found for OAuth: '.$credentialsPath);
    }

    $accessToken = file_get_contents($credentialsPath);
    $client->setAccessToken($accessToken);

    if ($client->isAccessTokenExpired()) {
        $client->refreshToken($client->getRefreshToken());
        file_put_contents($credentialsPath, $client->getAccessToken());
    }
```

Get contacts

```php
    $bexio = new \Bexio\Resource\Contact($client);
    
    $contacts = $bexio->getContacts();
```

