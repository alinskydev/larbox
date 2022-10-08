<?php

namespace Http\Client\Box\Tests\Brand;

use App\Services\Test\Feature\ShowFeatureTestService;

class ShowTest extends _TestCase
{
    public function test_success()
    {
        (new ShowFeatureTestService($this))->show(
            path: 'brand-2',
        );
    }

    public function test_error___Not_your_record()
    {
        (new ShowFeatureTestService($this))->show(
            path: 'brand-1',
            assertStatus: 404,
        );
    }
}
