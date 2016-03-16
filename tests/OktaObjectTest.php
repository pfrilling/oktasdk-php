<?php

use Okta\Client as OktaClient;

class OktaObjectTest extends PHPUnit_Framework_TestCase
{

    protected $okta;

    public function __construct() {
        $this->okta = new OktaClient('test', 'not_a_real_key');
    }

    public function testClientObject() {
        $this->assertInstanceOf('Okta\Client', $this->okta);
    }

    public function testAppObject() {
        $this->assertInstanceOf('Okta\Resources\App', $this->okta->app);
    }

    public function testAppExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->app);
    }

    public function testAuthObject() {
        $this->assertInstanceOf('Okta\Resources\Authentication', $this->okta->auth);
    }

    public function testAuthExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->auth);
    }

    public function testEventObject() {
        $this->assertInstanceOf('Okta\Resources\Event', $this->okta->event);
    }

    public function testEventExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->event);
    }

    public function testFactorObject() {
        $this->assertInstanceOf('Okta\Resources\Factor', $this->okta->factor);
    }

    public function testFactorExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->factor);
    }

    public function testGroupObject() {
        $this->assertInstanceOf('Okta\Resources\Group', $this->okta->group);
    }

    public function testGroupExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->group);
    }

    public function testRoleObject() {
        $this->assertInstanceOf('Okta\Resources\Role', $this->okta->role);
    }

    public function testRoleExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->role);
    }

    public function testSchemaObject() {
        $this->assertInstanceOf('Okta\Resources\Schema', $this->okta->schema);
    }

    public function testSchemaExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->schema);
    }

    public function testSessionObject() {
        $this->assertInstanceOf('Okta\Resources\Session', $this->okta->session);
    }

    public function testSessionExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->session);
    }

    public function testUserObject() {
        $this->assertInstanceOf('Okta\Resources\User', $this->okta->user);
    }

    public function testUserExtendsBase() {
        $this->assertInstanceOf('Okta\Resources\Base', $this->okta->user);
    }

}
