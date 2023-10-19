<?php

namespace Http\Admin\Box\Tests\Tag;

use Modules\Box\Models\Tag;

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
        Tag::query()->findOrFail(2)->delete();

        $this->sendRequest(
            method: 'DELETE',
            path: '2/restore',
        );
    }
}
