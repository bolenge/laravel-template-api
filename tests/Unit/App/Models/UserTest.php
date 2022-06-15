<?php

namespace Tests\Unit\App\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_getJWTCustomClaims_get_an_array()
    {
        $user = new User();

        $this->assertIsArray($user->getJWTCustomClaims());
    }

    public function test_getJWTIdentifier_get_null_value()
    {
        $user = new User();

        $this->assertNull($user->getJWTIdentifier());
    }
}
