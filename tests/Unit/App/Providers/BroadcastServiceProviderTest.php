<?php

namespace Tests\Unit\App\Providers;

use App\Providers\BroadcastServiceProvider;
use Tests\TestCase;

class BroadcastServiceProviderTest extends TestCase
{
    public function test_the_boot_get_null()
    {
        $provider = new BroadcastServiceProvider($this->createApplication());

        $this->assertNull($provider->boot());
    }
}
