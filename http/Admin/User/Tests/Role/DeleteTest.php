<?php

namespace Http\Admin\User\Tests\Role;

class DeleteTest extends _TestCase
{
    public function test_delete(): void
    {
        $this->sendRequest(
            method: 'DELETE',
            path: '3',
        );
    }

    public function test_error___Undeletable(): void
    {
        $this->sendRequest(
            method: 'DELETE',
            path: '1',
            assertStatus: 400,
        );
    }
}
