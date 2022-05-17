<?php

namespace Tests\Feature\Admin\User\User;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'username' => 'agent_2',
            'email' => 'agent_2@local.host',
            'new_password' => 'vu8eaajiaw',
            'full_name' => 'Agent 2',
            'phone' => 'Phone 2',
            'role' => 'agent',
            'regions' => [1, 2],
            'cities' => [1],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
