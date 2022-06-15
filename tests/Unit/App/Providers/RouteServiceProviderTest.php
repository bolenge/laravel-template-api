<?php

namespace Tests\Unit\App\Providers;

use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class RouteServiceProviderTest extends TestCase
{
    private $provider;

    public function setUp() : void
    {
        parent::setUp();

        $this->provider = new RouteServiceProvider($this->createApplication());
    }

    public function test_boot_provider()
    {
        $this->assertEmpty($this->provider->boot());
    }

    public function test_boot_routes_running()
    {
        $this->assertEmpty($this->provider->bootRoutes());
    }
}
