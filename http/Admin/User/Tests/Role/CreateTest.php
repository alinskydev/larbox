<?php

namespace Http\Admin\User\Tests\Role;

use App\Testing\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            body: [
                'name' => FormHelper::localized('Role 3'),
                'routes' => [
                    'admin.box.box.index',
                    'admin.box.box.create',
                    'admin.box.box.update',
                    'admin.section.show',
                ],
            ],
        );
    }
}
