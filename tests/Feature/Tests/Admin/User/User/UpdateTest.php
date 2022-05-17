<?php

namespace Tests\Feature\Tests\Admin\User\User;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    protected array $requestQuery = [
        '_method' => self::REQUEST_METHOD_PATCH,
    ];

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'username' => 'admin',
            'email' => 'admin@local.host',

            'profile' => [
                'full_name' => 'Administrator',
                'phone' => 'Phone 1',
                'image' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_change_password()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'new_password' => 'admin123',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_superadmin_role_is_unchangeable()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'role' => 'registered',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(422);
    }
}
