<?php

namespace Http\Website\Feedback\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class CallbackTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            path: 'callback',
            body: [
                'full_name' => 'Full name 3',
                'phone' => '+998 00 000 00 03',
                'message' => 'Message 3',
            ],
        );
    }
}
