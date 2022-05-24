<?php

namespace Http\Common\Auth\Tests;

class ResetPasswordScenarioTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_send_email()
    {
        $this->requestUrl .= '/reset-password/send-email';

        $this->requestBody = [
            'email' => 'registered_1@local.host',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }

    public function test_verify_code_error()
    {
        $this->requestUrl .= '/reset-password/verify-code';

        $this->requestBody = [
            'email' => 'registered_1@local.host',
            'reset_password_code' => '12345678',
            'new_password' => 'test1234',
            'new_password_confirmation' => 'test1234',
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
            'new_password' => 'test1234',
            'new_password_confirmation' => 'test1234',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(422);
    }
}
