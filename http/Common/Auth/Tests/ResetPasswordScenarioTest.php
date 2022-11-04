<?php

namespace Http\Common\Auth\Tests;

class ResetPasswordScenarioTest extends _TestCase
{
    public function test_send_code()
    {
        $this->processPost(
            path: 'reset-password/send-code',
            body: [
                'email' => 'registered_1@local.host',
            ],
        );
    }

    public function test_verify_code()
    {
        $this->processPost(
            path: 'reset-password/verify-code',
            body: [
                'email' => 'registered_1@local.host',
                'code' => '1234',
            ],
        );
    }

    public function test_complete()
    {
        $this->processPost(
            path: 'reset-password/complete',
            body: [
                'email' => 'registered_1@local.host',
                'code' => '1234',
                'new_password' => 'user1234',
                'new_password_confirmation' => 'user1234',
            ],
        );
    }
}
