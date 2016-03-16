<?php

namespace App\Libs\Okta;

use GuzzleHttp\Client as GuzzleClient;

use App\Libs\Okta\Resources\App;
use App\Libs\Okta\Resources\Authentication;
use App\Libs\Okta\Resources\Event;
use App\Libs\Okta\Resources\Factor;
use App\Libs\Okta\Resources\Group;
use App\Libs\Okta\Resources\Role;
use App\Libs\Okta\Resources\Schema;
use App\Libs\Okta\Resources\Session;
use App\Libs\Okta\Resources\User;

/**
 * Okta\Client class
 *
 * @author Chris Kankiewicz <ckankiewicz@io.com>
 */
class Client {

    protected $org     = null;
    protected $key     = null;
    protected $headers = [];

    /**
     * Okta\Client constructor method
     *
     * @param string $org     Your organization's subdomain (tenant)
     * @param string $key     Your Okta API key
     * @param array  $headers Array of headers in header_name => value format
     */
    public function __construct($org, $key, array $headers = null) {

        $this->org = $org;
        $this->key = $key;

        if (isset($headers)) {
            $this->headers = $headers;
        }

        $client = new GuzzleClient ([
            'base_uri'   => 'https://' . $this->org . '.okta.com/api/v1/',
            'exceptions' => false,
            'headers'    => array_merge([
                'Authorization' => 'SSWS ' . $this->key,
                'Content-Type'  => 'application/json'
            ], $this->headers)
        ]);

        $this->app     = new App($client);
        $this->auth    = new Authentication($client);
        $this->event   = new Event($client);
        $this->factor  = new Factor($client);
        $this->group   = new Group($client);
        $this->role    = new Role($client);
        $this->schema  = new Schema($client);
        $this->session = new Session($client);
        $this->user    = new User($client);

    }

}
