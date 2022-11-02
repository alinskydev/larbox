<?php

namespace Http\Admin\Box\Tests\Category;

use App\Services\Test\Feature\ShowFeatureTestService;

class ShowTest extends _TestCase
{
    public function test_success()
    {
        (new ShowFeatureTestService($this))->show('8');
    }
}
