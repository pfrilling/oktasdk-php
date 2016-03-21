OktaSDK-PHP
===========

[![Build Status](https://travis-ci.com/iodatacenters/oktasdk-php.svg?token=9xaCNqHne23WxG4ZXsCj&branch=master)](https://travis-ci.com/iodatacenters/oktasdk-php)

PHP client library for the Okta API (v1)

Refer to the full [Okta API documentation](http://developer.okta.com/docs/api)
for more complete information on each resource/component.


Install with Composer
---------------------

```bash
composer require iodatacenters/oktasdk
```


Initializing the Client
-----------------------

To initialize the client object you must pass in your Okta organization
subdomain and API key as parameters. For example, if your Okta domain is
`https://foo.okta.com`, your org prefix is `foo`. For instructions on how to get
an API key for your organization, see
[Obtaining a token](http://developer.okta.com/docs/api/getting_started/getting_a_token.html).

#### Example:

```php
use Okta\Client as OktaClient;

$okta = new OktaClient('foo', 'api_key');
```


Usage
-----

All Okta resources are available via the `$okta->$resource->$method` syntax
where `$resource` is the lower case, singular name of the resource (i.e. -
Users = `user`, Groups = `group`, etc.) and `$method` is the method name (see
the docs for all available methods). The only exception being the Authentication
resource for which the method name is `auth` (because `authentication` is just
too long).

#### Example:

```php
// Get's user by ID
$user = $okta->user->get('jpinkerton');

// Add user to a group
$group = $okta->group->addUser($someGroupId, $user->id);

// Get a user's apps
$userApps = $okta->user->apps($user->id);
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

See documentation for available exception methods.


Contributing
------------

  1. [Fork](https://github.com/iodatacenters/oktasdk-php#fork-destination-box)
     the repository

  2. Clone your fork:

     ```bash
     git clone git@github.com:your-username/oktasdk-php.git
     # NOTE: Be sure to use your fork's repository URL
     ```

  3. In your local copy, create a branch:

     ```bash
     git checkout -b descriptive-branch-name'
     ```

  4. Make your changes

  5. Commit your changes:

     ```bash
     git commit -m "Your commit notes here"
     # NOTE: Be descriptive with your commit notes
     ```

  6. Push your branch:

     ```bash
     git push origin descriptive-branch-name
     ```

  7. [Open a Pull Request](https://github.com/iodatacenters/oktasdk-php/pull/new)
     on GitHub.
