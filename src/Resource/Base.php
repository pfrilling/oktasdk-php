<?php

namespace Okta\Resource;

use Okta\Client as OktaClient;
use Okta\Request as OktaRequest;

/**
 * Okta resource base class.  All Okta resources should extend this class.
 */
abstract class Base
{

    /**
     * @var object Okta\Request object
     */
    protected $request;

    /**
     * Okta\Resources\Base constructor method
     *
     * @param object $client Instance of GuzzleClient
     */
    public function __construct(OktaClient $client) {
        $this->request = new OktaRequest($client);
    }

}
