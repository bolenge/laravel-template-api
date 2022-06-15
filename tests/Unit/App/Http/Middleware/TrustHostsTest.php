<?php

namespace Tests\Unit\App\Http\Middleware;

use App\Http\Middleware\TrustHosts;
use Tests\TestCase;

class TrustHostsTest extends TestCase
{
    public function test_hosts_is_array()
    {
        $trustHosts = new TrustHosts($this->createApplication());

        $this->assertIsArray($trustHosts->hosts());
    }
}
