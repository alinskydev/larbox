<?php

namespace Http\Admin\User\Tests\Profile;

class ProfileTest extends _TestCase
{
    public function test_show(): void
    {
        $this->processShow('');
    }

    public function test_update_without_new_password(): void
    {
        $this->processUpdate(
            path: '',
            body: [
                'username' => 'admin',
                'email' => 'admin@local.host',

                'profile' => [
                    'full_name' => 'Administrator',
                    'phone' => '+998000000001',
                    'image' => $this->formHelper::files(),
                ],
            ],
        );
    }

    public function test_update_with_new_password(): void
    {
        $this->processUpdate(
            path: '',
            body: [
                'username' => 'admin',
                'email' => 'admin@local.host',
                'new_password' => 'admin123',
                'new_password_confirmation' => 'admin123',

                'profile' => [
                    'full_name' => 'Administrator',
                    'phone' => '+998000000001',
                    'image' => $this->formHelper::files(),
                ],
            ],
        );
    }
}
