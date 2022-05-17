<?php

namespace Tests\Feature\Common\Auth;

class ResetPasswordTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_send_email()
    {
        $this->requestUrl .= '/reset-password-send-email';

        $this->requestBody = [
            'email' => 'agent_1@local.host',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }

    public function test_set_new_password_error()
    {
        $this->requestUrl .= '/reset-password';

        $this->requestBody = [
            'email' => 'agent_1@local.host',
            'reset_password_code' => '12345678',
            'new_password' => 'vu8eaajiaw',
            'new_password_confirmation' => 'vu8eaajiaw',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(422);
    }
}
