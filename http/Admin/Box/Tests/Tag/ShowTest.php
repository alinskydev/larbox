<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Tests\Feature\Traits\ShowFeatureTestTrait;

class ShowTest extends _TestCase
{
    use ShowFeatureTestTrait;

    public function test_success()
    {
        $this->processShow();
    }
}
