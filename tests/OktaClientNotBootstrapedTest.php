<?php

use Okta\Client as OktaClient;

class OktaClientNotBootstrapedTest extends PHPUnit_Framework_TestCase
{

    protected $okta;

    public function __construct() {
        $this->okta = new OktaClient('test', 'not_a_real_key', [], false);
    }

    public function testAppPropertyIsNull() {
        $this->assertNull($this->okta->app);
    }

    public function testAuthPropertyIsNull() {
        $this->assertNull($this->okta->auth);
    }

    public function testEventPropertyIsNull() {
        $this->assertNull($this->okta->event);
    }

    public function testFactorPropertyIsNull() {
        $this->assertNull($this->okta->factor);
    }

    public function testGroupPropertyIsNull() {
        $this->assertNull($this->okta->group);
    }

    public function testRolePropertyIsNull() {
        $this->assertNull($this->okta->role);
    }

    public function testSchemaPropertyIsNull() {
        $this->assertNull($this->okta->schema);
    }

    public function testSessionPropertyIsNull() {
        $this->assertNull($this->okta->session);
    }

    public function testUserPropertyIsNull() {
        $this->assertNull($this->okta->user);
    }

}
