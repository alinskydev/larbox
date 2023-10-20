<?php

namespace Http\Admin\User\Tests\Role;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: '2',
            body: [
                'name' => FormHelper::localized('Moderator'),
                'routes' => [
                    'admin.box.box.index',
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
