<?php

namespace Http\Client\User\Tests;

use App\Helpers\Test\Feature\FormHelper;

class ProfileTest extends _TestCase
{
    public function test_show()
    {
        $this->requestMethod = self::REQUEST_METHOD_GET;

        $this->requestUrl .= '/profile';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_update()
    {
        $this->requestMethod = self::REQUEST_METHOD_PUT;

        $this->requestUrl .= '/profile';

        $this->requestBody = [
            'username' => 'registered_1',
            'email' => 'registered_1@local.host',
            'new_password' => 'user1234',
            'new_password_confirmation' => 'user1234',

            'profile' => [
                'full_name' => 'Registered 1',
                'phone' => '+998000000001',
                'image' => FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
