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
    $bexio = new Bexio($client);
    
    $contacts = $bexio->getContacts();
```