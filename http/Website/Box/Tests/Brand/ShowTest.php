<?php

namespace Http\Website\Box\Tests\Brand;

use App\Tests\Feature\Traits\ShowFeatureTestTrait;

class ShowTest extends _TestCase
{
    use ShowFeatureTestTrait;

    public function test_success()
    {
        $this->processShow('brand-2');
    }

    public function test_error___Not_your_record()
    {
        $this->processShow('brand-1', 404);
    }
}
