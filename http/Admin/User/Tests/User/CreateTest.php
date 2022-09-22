<?php

namespace Http\Admin\User\Tests\User;

use App\Helpers\Test\Feature\FormHelper;

class CreateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'role_id' => 2,
            'username' => 'moderator_2',
            'email' => 'moderator_2@local.host',
            'new_password' => 'user1234',
            'new_password_confirmation' => 'user1234',

            'profile' => [
                'full_name' => 'Moderator 2',
                'phone' => '+998000000012',
                'image' => FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
