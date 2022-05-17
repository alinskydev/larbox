<?php

namespace Tests\Feature\Tests\Admin\User\User;

use Illuminate\Http\UploadedFile;

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

            'profile' => [
                'full_name' => 'Registered 2',
                'phone' => 'Phone 2',
                'image' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
