<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use Tests\TestCase;
use Mockery as m;

class RegisterControllerTest extends TestCase
{
    protected $registerController;
    protected $userMock;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->userMock = m::mock(UserRepositoryInterface::class);
        $this->registerController = new RegisterController($this->userMock);
    }

    public function testLogin()
    {
        $result = $this->registerController->register();
        $this->assertEquals('cms.register', $result->getName());
    }

    public function testHandelRegister()
    {
        $request = new RegisterRequest();
        $this->userMock->shouldReceive('createUserCms');
        $result = $this->registerController->handelRegister($request);
        $this->assertEquals(route('auth.login'), $result->getTargetUrl());
    }

    public function testRegisterCustomer()
    {
        $result = $this->registerController->registerCustomer();
        $this->assertEquals('customer.pages.auth.register', $result->getName());
    }

    public function testHandelRegisterCustomer()
    {
        $request = new RegisterRequest();
        $this->userMock->shouldReceive('createUser');
        $result = $this->registerController->handelRegisterCustomer($request);
        $this->assertEquals(route('auth.customer.login'), $result->getTargetUrl());
    }

    protected function tearDown(): void
    {
        m::close();
        unset($this->userMock);
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}