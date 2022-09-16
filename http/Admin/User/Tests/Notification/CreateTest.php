<?php

namespace Http\Admin\User\Tests\Notification;

use App\Tests\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'user_query' => '?filter[common]=Admin&filter[role_id]=1',
            'type' => 'message',
            'message' => 'Message 3',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
