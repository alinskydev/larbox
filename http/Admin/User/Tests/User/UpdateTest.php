<?php

namespace Http\Admin\User\Tests\User;

use App\Tests\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'username' => 'admin',
            'email' => 'admin@local.host',

            'profile' => [
                'full_name' => 'Administrator',
                'phone' => '+998001234567',
                'image' => FormHelper::file(),
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
            'new_password_confirmation' => 'admin123',
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
