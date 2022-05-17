<?php

namespace Tests\Feature\Admin\User\User;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'username' => 'admin',
            'email' => 'admin@local.host',
            'full_name' => 'Administrator',
            'phone' => 'Phone 1',
            'role' => 'admin',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_change_password()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'new_password' => 'vu8eaajiaw',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_superadmin_role_is_unchangeable()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'role' => 'agent',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(422);
    }
}
