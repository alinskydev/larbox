<?php

namespace Http\Admin\User\Tests\User;

use Modules\User\Models\User;

class DeleteTest extends _TestCase
{
    public function test_delete(): void
    {
        $this->sendRequest(
            method: 'DELETE',
            path: '2',
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

    public function test_restore(): void
    {
        User::query()->findOrFail(2)->delete();

        $this->sendRequest(
            method: 'DELETE',
            path: '2/restore',
        );
    }
}
