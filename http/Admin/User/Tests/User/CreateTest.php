<?php

namespace Http\Admin\User\Tests\User;

use App\Helpers\Test\Feature\FormHelper;

class CreateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'username' => 'registered_2',
            'email' => 'registered_2@local.host',
            'role' => 'registered',
            'new_password' => 'user1234',
            'new_password_confirmation' => 'user1234',

            'profile' => [
                'full_name' => 'Registered 2',
                'phone' => '+998000000002',
                'image' => FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
