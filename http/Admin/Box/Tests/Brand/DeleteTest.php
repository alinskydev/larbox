<?php

namespace Http\Admin\Box\Tests\Brand;

class DeleteTest extends _TestCase
{
    public function test_delete(): void
    {
        $this->sendRequest(
            method: 'DELETE',
            path: '2',
        );
    }

    public function test_restore(): void
    {
        $this->sendRequest(
            method: 'DELETE',
            path: '2/restore',
        );
    }
}
