<?php

namespace Http\Admin\User\Tests\User;

use App\Testing\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            body: [
                'role_id' => 2,
                'username' => 'moderator_2',
                'email' => 'moderator_2@local.host',
                'new_password' => 'user1234',
                'new_password_confirmation' => 'user1234',

                'profile' => [
                    'full_name' => 'Moderator 2',
                    'phone' => '+998000000012',
                    ...FormHelper::deleteableFiles(
                        field: 'image',
                        files: FormHelper::files(),
                        oldKeys: [],
                    ),
                ],
            ],
        );
    }
}
