<?php

namespace Http\Admin\User\Tests\Role;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processUpdate(
            path: '2',
            body: [
                'name' => $this->formHelper::localized('Moderator'),
                'routes' => [
                    'admin.box.box.*',
                    'admin.box.tag.index',
                    'admin.box.tag.show',
                    'admin.box.tag.create',
                    'admin.box.tag.update',
                    'admin.section.show',
                ],
            ],
        );
    }
}
