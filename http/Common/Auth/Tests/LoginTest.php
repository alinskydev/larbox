<?php

namespace Http\Common\Auth\Tests;

class LoginTest extends _TestCase
{
    public function test_as_admin(): void
    {
        $this->processPost(
            path: 'login',
            body: [
                'username' => 'admin',
                'password' => env('USER_ADMIN_PASSWORD'),
            ],
        );
    }

    public function test_as_registered(): void
    {
        $this->processPost(
            path: 'login',
            body: [
                'username' => 'registered_1',
                'password' => 'user1234',
            ],
        );
    }
}
