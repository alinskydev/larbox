<?php

namespace Http\Website\User\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class ProfileTest extends _TestCase
{
    public string $requestUrl = 'website/user/profile';

    public function test_show(): void
    {
        $this->sendRequest();
    }

    public function test_update_without_new_password(): void
    {
        $this->sendRequest(
            method: 'PUT',
            body: [
                'username' => 'registered_1',
                'email' => 'registered_1@local.host',

                'profile' => [
                    'full_name' => 'Registered 1',
                    'phone' => '+998000000001',
                    'image' => FormHelper::files(),
                ],
            ],
        );
    }

    public function test_update_with_new_password(): void
    {
        $this->sendRequest(
            method: 'PUT',
            body: [
                'username' => 'registered_1',
                'email' => 'registered_1@local.host',
                'new_password' => 'user1234',
                'new_password_confirmation' => 'user1234',

                'profile' => [
                    'full_name' => 'Registered 1',
                    'phone' => '+998000000001',
                    'image' => FormHelper::files(),
                ],
            ],
        );
    }
}
