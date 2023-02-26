<?php

namespace Http\Website\Box\Tests\Brand;

class ShowTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            path: 'brand-2',
        );
    }

    public function test_error___Another_user_record(): void
    {
        $this->sendRequest(
            path: 'brand-1',
            assertStatus: 404,
        );
    }
}
