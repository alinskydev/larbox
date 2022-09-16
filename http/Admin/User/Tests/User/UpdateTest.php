<?php

namespace Http\Admin\User\Tests\User;

use App\Helpers\Test\Feature\FormHelper;

class UpdateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PUT;

    public function test_success()
    {
        $this->requestUrl .= '/2';

        $this->requestBody = [
            'username' => 'moderator_1',
            'email' => 'moderator_1@local.host',
            'role_id' => 2,
            'new_password' => 'user1234',
            'new_password_confirmation' => 'user1234',

            'profile' => [
                'full_name' => 'Moderator 1',
                'phone' => '+998000000002',
                'image' => FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_superadmin_role_is_unchangeable()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'role_id' => 2,
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(422);
    }
}
