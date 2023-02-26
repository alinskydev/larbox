<?php

namespace Http\Common\Auth\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class LoginTest extends _TestCase
{
    public function test_as_admin(): void
    {
        $this->sendRequest(
            method: 'POST',
            path: 'login',
            body: [
                'username' => 'admin',
                'password' => 'admin123',
            ],
        );
    }

    public function test_as_registered(): void
    {
        $this->sendRequest(
            method: 'POST',
            path: 'login',
            body: [
                'username' => 'registered_1',
                'password' => 'user1234',
            ],
        );
    }
}
