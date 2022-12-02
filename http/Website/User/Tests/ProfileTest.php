<?php

namespace Http\Website\User\Tests;

class ProfileTest extends _TestCase
{
    public function test_show(): void
    {
        $this->processShow('profile');
    }

    public function test_update(): void
    {
        $this->processUpdate(
            path: 'profile',
            body: [
                'username' => 'registered_1',
                'email' => 'registered_1@local.host',
                'new_password' => 'user1234',
                'new_password_confirmation' => 'user1234',

                'profile' => [
                    'full_name' => 'Registered 1',
                    'phone' => '+998000000001',
                    'image' => $this->formHelper::file(),
                ],
            ],
        );
    }
}
