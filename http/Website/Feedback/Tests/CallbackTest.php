<?php

namespace Http\Website\Feedback\Tests;

use App\Helpers\Test\Feature\FormHelper;

class CallbackTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestUrl .= '/callback';

        $this->requestBody = [
            'full_name' => 'Full name 3',
            'phone' => '+998 00 000 00 03',
            'message' => 'Message 3',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
