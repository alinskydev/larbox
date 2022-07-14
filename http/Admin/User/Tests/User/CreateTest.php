<?php

namespace Http\Admin\User\Tests\User;

use App\Tests\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'username' => 'registered_2',
            'email' => 'registered_2@local.host',
            'role' => 'registered',
            'new_password' => 'test1234',
            'new_password_confirmation' => 'test1234',

            'profile' => [
                'full_name' => 'Registered 2',
                'phone' => 'Phone 2',
                'image' => FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
