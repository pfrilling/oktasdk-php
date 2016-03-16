<?php

namespace App\Libs\Okta\Resources;

use GuzzleHttp\Client as GuzzleClient;
use App\Libs\Okta\Request as OktaRequest;

abstract class Base
{

    protected $request = null;

    /**
     * Okta\Resources\Base constructor method
     *
     * @param string $org     Your organization's subdomain (tenant)
     * @param string $apiKey  Your Okta API key
     * @param array  $headers Array of headers in header_name => value format
     */
    public function __construct(GuzzleClient $client) {
        $this->request = new OktaRequest($client);
    }

}
