<?php

namespace Http\Common\Auth\Tests;

class ResetPasswordScenarioTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_send_code()
    {
        $this->requestUrl .= '/reset-password/send-code';

        $this->requestBody = [
            'email' => 'registered_1@local.host',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_verify_code()
    {
        $this->requestUrl .= '/reset-password/verify-code';

        $this->requestBody = [
            'email' => 'registered_1@local.host',
            'code' => '1234',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_complete()
    {
        $this->requestUrl .= '/reset-password/complete';

        $this->requestBody = [
            'email' => 'registered_1@local.host',
            'code' => '1234',
            'new_password' => 'user1234',
            'new_password_confirmation' => 'user1234',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
