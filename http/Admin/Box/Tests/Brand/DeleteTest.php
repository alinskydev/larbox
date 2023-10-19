<?php

namespace Http\Admin\Box\Tests\Brand;

use Modules\Box\Models\Brand;

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
        Brand::query()->findOrFail(2)->delete();

        $this->sendRequest(
            method: 'DELETE',
            path: '2/restore',
        );
    }
}
