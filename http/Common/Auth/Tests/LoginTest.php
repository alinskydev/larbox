<?php

namespace Http\Common\Auth\Tests;

class LoginTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_as_admin()
    {
        $this->requestUrl .= '/login';

        $this->requestBody = [
            'username' => 'admin',
            'password' => 'admin123',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_as_registered()
    {
        $this->requestUrl .= '/login';

        $this->requestBody = [
            'username' => 'registered_1',
            'password' => 'test1234',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
