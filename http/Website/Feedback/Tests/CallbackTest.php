<?php

namespace Http\Website\Feedback\Tests;

class CallbackTest extends _TestCase
{
    public function test_success()
    {
        $this->processPost(
            path: 'callback',
            body: [
                'full_name' => 'Full name 3',
                'phone' => '+998 00 000 00 03',
                'message' => 'Message 3',
            ],
        );
    }
}
