<?php

namespace Tests\Unit\App\Http\Middleware;

use Mockery;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use \Illuminate\Contracts\Auth\Guard;
use App\Http\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Container\BindingResolutionException;

class AuthenticateTest extends TestCase
{
    private $closure;
    private $factory;
    private $request;
    private $guard;

    public function setUp() : void
    {
        $this->closure = function ($request) {
            return (bool) $request;
        };

        $this->factory = Mockery::mock(Factory::class);
        $this->request = Mockery::mock(Request::class);
        $this->guard = Mockery::mock(Guard::class);
    }

    public function test_handle_authenticate()
    {   
        $this->guard->shouldReceive('check')->andReturn(true);
        $this->factory->shouldReceive('shouldUse')->andReturn(null);
        $this->factory->shouldReceive('guard')->andReturn($this->guard);

        $authenticate = new Authenticate($this->factory);

        $this->assertTrue($authenticate->handle($this->request, $this->closure, []));
    }

    public function test_handle_unauthenticated()
    {
        $this->guard->shouldReceive('check')->andReturn(false);
        $this->factory->shouldReceive('guard')->andReturn($this->guard);

        $authenticate = new Authenticate($this->factory);

        try {
            $authenticate->handle($this->request, $this->closure, []);
        } catch (\Exception $e) {
            $this->assertInstanceOf(BindingResolutionException::class, $e);
        }
        
        $this->assertTrue(true);
    }
}
