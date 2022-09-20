<?php

namespace Http\Admin\User\Tests\Role;

use App\Helpers\Test\Feature\FormHelper;

class CreateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => FormHelper::localized('Role 3'),
            'routes' => [
                'admin.section.show',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
