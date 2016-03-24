<?php

use Okta\Client as OktaClient;

class OktaClientBootstrappedTest extends PHPUnit_Framework_TestCase
{

    protected $okta;

    public function __construct() {
        $this->okta = new OktaClient('test', 'not_a_real_key');
    }

    public function testClientObject() {
        $this->assertInstanceOf('Okta\Client', $this->okta);
    }

    public function testClientPropertyObject() {
        $this->assertInstanceOf('GuzzleHttp\Client', $this->okta->instance());
    }

    public function testAppPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\App', $this->okta->app);
    }

    public function testAppExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->app);
    }

    public function testAuthPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\Authentication', $this->okta->auth);
    }

    public function testAuthExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->auth);
    }

    public function testEventPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\Event', $this->okta->event);
    }

    public function testEventExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->event);
    }

    public function testFactorPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\Factor', $this->okta->factor);
    }

    public function testFactorExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->factor);
    }

    public function testGroupPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\Group', $this->okta->group);
    }

    public function testGroupExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->group);
    }

    public function testRolePropertyObject() {
        $this->assertInstanceOf('Okta\Resource\Role', $this->okta->role);
    }

    public function testRoleExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->role);
    }

    public function testSchemaPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\Schema', $this->okta->schema);
    }

    public function testSchemaExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->schema);
    }

    public function testSessionPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\Session', $this->okta->session);
    }

    public function testSessionExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->session);
    }

    public function testUserPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\User', $this->okta->user);
    }

    public function testUserExtendsBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->user);
    }

}
