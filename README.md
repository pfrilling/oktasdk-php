OktaSDK-PHP
===========

PHP client library for the Okta API (v1)


Install with Composer
---------------------

```bash
composer require iodatacenters/oktasdk
```


Initializing the Client
-----------------------

```php
use Okta\Client as OktaClient;

$org = 'foo'; // Your organization's subdomain (tenant) prefix
$apiKey = '2yXrPqciUlXtnmcCzrcCU2dh'; // Your Okta API key

$okta = new OktaClient($org, $apiKey);
```


Example Usage
-------------

```php
$user = $okta->user->get('user_id');
```


Handling Exceptions
-------------------

```php
use Okta\Exeception as OktaException;

try {
    $user = $okta->user->get('jpinkerton');
} catch (OktaException as $e) {
    return $e->getErrorSummary();
}
```
