<?php

namespace Http\Admin\User\Tests\Role;

use App\Services\Test\Feature\DeleteFeatureTestService;

class DeleteTest extends _TestCase
{
    public function test_delete()
    {
        (new DeleteFeatureTestService($this))->delete(
            path: '3',
        );
    }

    public function test_undeletable()
    {
        (new DeleteFeatureTestService($this))->delete(
            path: '1',
            assertStatus: 400,
        );
    }
}
