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

    public function test_verify_code_error()
    {
        $this->requestUrl .= '/reset-password/verify-code';

        $this->requestBody = [
            'email' => 'registered_1@local.host',
            'reset_password_code' => '12345678',
            'new_password' => 'user1234',
            'new_password_confirmation' => 'user1234',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(422);
    }

    public function test_set_new_password_error()
    {
        $this->requestUrl .= '/reset-password/set-new-password';

        $this->requestBody = [
            'email' => 'registered_1@local.host',
            'reset_password_code' => '12345678',
            'new_password' => 'user1234',
            'new_password_confirmation' => 'user1234',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(422);
    }
}
