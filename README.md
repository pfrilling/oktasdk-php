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

$okta = new OktaClient('org_prefix', 'your_okta_api_key');
```


Example Usage
-------------

```php
$okta->user->get('user_id');
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
