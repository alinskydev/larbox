<?php

namespace Http\Common\Auth\Tests;

use App\Testing\Feature\Helpers\FormHelper;
use Modules\Auth\Services\CodeService;

class ResetPasswordScenarioTest extends _TestCase
{
    public string $requestUrl = 'common/auth/reset-password';

    public function test_send_code(): void
    {
        $this->sendRequest(
            method: 'POST',
            path: 'send-code',
            body: [
                'email' => 'registered_1@local.host',
            ],
        );
    }

    public function test_verify_code(): void
    {
        $email = 'registered_1@local.host';

        $codeService = new CodeService($email);
        $codeService->sendCode();

        $this->sendRequest(
            method: 'POST',
            path: 'verify-code',
            body: [
                'email' => $email,
                'code' => '1234',
            ],
        );
    }

    public function test_complete(): void
    {
        $email = 'registered_1@local.host';

        $codeService = new CodeService($email);
        $codeService->sendCode();

        $this->sendRequest(
            method: 'POST',
            path: 'complete',
            body: [
                'email' => $email,
                'code' => '1234',
                'new_password' => 'user1234',
                'new_password_confirmation' => 'user1234',
            ],
        );
    }

    public function test_error___Throttle(): void
    {
        $this->requestUrl = 'common/auth/reset-password/send-code';

        for ($i = 1; $i <= 4; $i++) {
            $this->sendRequest(
                method: 'POST',
                body: [
                    'email' => 'registered_1@local.host',
                ],
                assertStatus: $i <= 3 ? 200 : 429,
            );
        }
    }
}
