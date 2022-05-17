<?php

namespace Tests\Feature\Common\Auth;

class LoginTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_as_admin()
    {
        $this->requestUrl .= '/login';

        $this->requestBody = [
            'username' => 'admin',
            'password' => 'vu8eaajiaw',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_as_agent()
    {
        $this->requestUrl .= '/login';

        $this->requestBody = [
            'username' => 'agent_1',
            'password' => 'vu8eaajiaw',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
