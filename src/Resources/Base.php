<?php

namespace Okta\Resources;

use GuzzleHttp\Client as GuzzleClient;
use Okta\Request as OktaRequest;

/**
 * Resource base class.  All resources should extend this class.
 */
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
