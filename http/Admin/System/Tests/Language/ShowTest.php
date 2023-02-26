<?php

namespace Http\Admin\System\Tests\Language;

class ShowTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            path: '1',
        );
    }
}
