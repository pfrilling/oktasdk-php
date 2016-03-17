<?php

namespace Okta;

use GuzzleHttp\Client as GuzzleClient;

use Okta\Request as OktaRequest;

use Okta\Resources\App;
use Okta\Resources\Authentication;
use Okta\Resources\Event;
use Okta\Resources\Factor;
use Okta\Resources\Group;
use Okta\Resources\Role;
use Okta\Resources\Schema;
use Okta\Resources\Session;
use Okta\Resources\User;

/**
 * Okta\Client class
 *
 * @author Chris Kankiewicz <ckankiewicz@io.com>
 */
class Client {

    /**
     * @var string Okta org subdomain prefix
     */
    protected $org;

    /**
     * @var string Okta API key
     */
    protected $key;

    /**
     * @var array Array of client headers
     */
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

        $this->app     = new App(new OktaRequest($client));
        $this->auth    = new Authentication(new OktaRequest($client));
        $this->event   = new Event(new OktaRequest($client));
        $this->factor  = new Factor(new OktaRequest($client));
        $this->group   = new Group(new OktaRequest($client));
        $this->role    = new Role(new OktaRequest($client));
        $this->schema  = new Schema(new OktaRequest($client));
        $this->session = new Session(new OktaRequest($client));
        $this->user    = new User(new OktaRequest($client));

    }

}
