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
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
