<?php

namespace Http\Admin\Feedback\Tests\Callback;

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
