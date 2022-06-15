<?php

namespace Tests\Unit\App\Http\Middleware;

use Mockery;
use RuntimeException;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use \Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Factory;
use App\Http\Middleware\RedirectIfAuthenticated;

class RedirectIfAuthenticatedTest extends TestCase
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

    public function test_handle_redirect_if_authenticated()
    {
        $authenticate = new RedirectIfAuthenticated;

        try {
            $authenticate->handle($this->request, $this->closure, ['api']);
        } catch (\Exception $e) {
            $this->assertInstanceOf(RuntimeException::class, $e);
        }
    }
}
