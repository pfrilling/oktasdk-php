<?php

use Okta\Client as OktaClient;
use Okta\Exception as OktaException;

class OktaExceptionTest extends PHPUnit_Framework_TestCase
{

    protected $okta;
    protected $exception;

    public function __construct() {
        $this->okta      = new OktaClient('test', 'not_a_real_key');
        $this->exception = new OktaException(new stdClass);
    }

    public function testExceptionObject() {
        $this->assertInstanceOf('Okta\Exception', $this->exception);
    }

    /**
     * @expectedException Okta\Exception
     */
    public function testThrownException() {
        throw $this->exception;
    }

}
