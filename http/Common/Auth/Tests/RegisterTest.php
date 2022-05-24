<?php

namespace Http\Common\Auth\Tests;

use Illuminate\Http\UploadedFile;

class RegisterTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestUrl .= '/register';

        $this->requestBody = [
            'username' => 'registered_3',
            'email' => 'registered_3@local.host',
            'new_password' => 'test1234',
            'new_password_confirmation' => 'test1234',

            'profile' => [
                'full_name' => 'Registered 3',
                'phone' => 'Phone 3',
                'image' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
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
            'password' => 'test1234',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
