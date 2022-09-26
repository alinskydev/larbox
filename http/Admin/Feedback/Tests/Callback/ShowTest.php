<?php

namespace Http\Admin\Feedback\Tests\Callback;

use App\Services\Test\Feature\ShowFeatureTestService;

class ShowTest extends _TestCase
{
    public function test_success()
    {
        (new ShowFeatureTestService($this))->show();
    }
}
