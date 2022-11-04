<?php

namespace Http\Common\Auth\Tests;

class RegisterTest extends _TestCase
{
    public function test_success()
    {
        $this->processPost(
            path: 'register',
            body: [
                'username' => 'registered_3',
                'email' => 'registered_3@local.host',
                'password' => 'user1234',
                'password_confirmation' => 'user1234',

                'profile' => [
                    'full_name' => 'Registered 3',
                    'phone' => '+998000000003',
                    'image' => $this->formHelper::file(),
                ],
            ],
        );
    }

    public function test_login_as_new_user()
    {
        $this->processPost(
            path: 'login',
            body: [
                'username' => 'registered_3',
                'password' => 'user1234',
            ],
        );
    }
}
