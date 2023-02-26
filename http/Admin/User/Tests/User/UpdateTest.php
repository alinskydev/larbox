<?php

namespace Http\Admin\User\Tests\User;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: '2',
            body: [
                'role_id' => 2,
                'username' => 'moderator_1',
                'email' => 'moderator_1@local.host',
                'new_password' => 'user1234',
                'new_password_confirmation' => 'user1234',

                'profile' => [
                    'full_name' => 'Moderator 1',
                    'phone' => '+998000000011',
                    ...FormHelper::deleteableFiles(
                        field: 'image',
                        files: FormHelper::files(),
                        oldKeys: [0],
                    ),
                ],
            ],
        );
    }

    public function test_superadmin_role_is_unchangeable(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: '1',
            body: [
                'role_id' => 2,
            ],
            assertStatus: 422,
        );
    }
}
