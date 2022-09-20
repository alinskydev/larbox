<?php

namespace Http\Admin\User\Tests\Role;

use App\Helpers\Test\Feature\FormHelper;

class UpdateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PUT;

    public function test_success()
    {
        $this->requestUrl .= '/2';

        $this->requestBody = [
            'name' => FormHelper::localized('Moderator'),
            'routes' => [
                'admin.box.box.*',
                'admin.box.tag.index',
                'admin.box.tag.show',
                'admin.box.tag.store',
                'admin.box.tag.update',
                'admin.section.show',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
