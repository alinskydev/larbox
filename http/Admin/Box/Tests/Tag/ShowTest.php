<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Services\Test\Feature\ShowFeatureTestService;

class ShowTest extends _TestCase
{
    public function test_success()
    {
        (new ShowFeatureTestService($this))->show();
    }
}
