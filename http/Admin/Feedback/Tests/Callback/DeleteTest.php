<?php

namespace Http\Admin\Feedback\Tests\Callback;

use Modules\Feedback\Models\Callback;

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
        Callback::query()->findOrFail(2)->delete();

        $this->sendRequest(
            method: 'DELETE',
            path: '2/restore',
        );
    }
}
