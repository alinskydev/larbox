<?php

namespace Http\Common\Auth\Tests;

use App\Helpers\Test\Feature\FormHelper;

class RegisterTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestUrl .= '/register';

        $this->requestBody = [
            'username' => 'registered_3',
            'email' => 'registered_3@local.host',
            'password' => 'user1234',
            'password_confirmation' => 'user1234',

            'profile' => [
                'full_name' => 'Registered 3',
                'phone' => '+998000000003',
                'image' => FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_login_as_new_user()
    {
        $this->requestUrl .= '/login';

        $this->requestBody = [
            'username' => 'registered_3',
            'password' => 'user1234',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
