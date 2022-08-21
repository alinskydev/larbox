<?php

namespace Http\Admin\User\Tests\Profile;

use App\Tests\Feature\Helpers\FormHelper;

class ProfileTest extends _TestCase
{
    public function test_show()
    {
        $this->requestMethod = self::REQUEST_METHOD_GET;

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_update()
    {
        $this->requestMethod = self::REQUEST_METHOD_PUT;

        $this->requestBody = [
            'username' => 'admin',
            'email' => 'admin@local.host',
            'new_password' => 'admin123',
            'new_password_confirmation' => 'admin123',

            'profile' => [
                'full_name' => 'Administrator',
                'phone' => '+998000000001',
                'image' => FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
