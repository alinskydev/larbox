<?php

namespace Http\Website\Box\Tests\Brand;

class DeleteTest extends _TestCase
{
    public function test_delete(): void
    {
        $this->sendRequest(
            method: 'DELETE',
            path: 'brand-2',
        );
    }

    public function test_error___Another_user_record(): void
    {
        $this->sendRequest(
            method: 'DELETE',
            path: 'brand-1',
            assertStatus: 404,
        );
    }
}
