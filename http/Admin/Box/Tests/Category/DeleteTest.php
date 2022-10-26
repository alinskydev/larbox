<?php

namespace Http\Admin\Box\Tests\Category;

use App\Services\Test\Feature\DeleteFeatureTestService;

class DeleteTest extends _TestCase
{
    public function test_delete()
    {
        (new DeleteFeatureTestService($this))->delete();
    }

    public function test_restore()
    {
        (new DeleteFeatureTestService($this))->restore();
    }
}
