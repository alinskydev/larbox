<?php

namespace Http\Public\User\Tests;

use App\Tests\Feature\Helpers\FormHelper;

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
            'new_password' => 'test1234',
            'new_password_confirmation' => 'test1234',

            'profile' => [
                'full_name' => 'Registered 1',
                'phone' => '+44001234567',
                'image' => FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
