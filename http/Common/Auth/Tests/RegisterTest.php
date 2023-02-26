<?php

namespace Http\Common\Auth\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class RegisterTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            path: 'register',
            body: [
                'username' => 'registered_3',
                'email' => 'registered_3@local.host',
                'password' => 'user1234',
                'password_confirmation' => 'user1234',

                'profile' => [
                    'full_name' => 'Registered 3',
                    'phone' => '+998000000003',
                    'image' => FormHelper::files(),
                ],
            ],
        );
    }
}
