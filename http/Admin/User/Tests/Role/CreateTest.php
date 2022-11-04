<?php

namespace Http\Admin\User\Tests\Role;

class CreateTest extends _TestCase
{
    public function test_success()
    {
        $this->processPost(
            body: [
                'name' => $this->formHelper::localized('Role 3'),
                'routes' => [
                    'admin.section.show',
                ],
            ],
            assertStatus: 201,
        );
    }
}
