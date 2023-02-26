<?php

namespace Http\Admin\Feedback\Tests\Callback;

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
