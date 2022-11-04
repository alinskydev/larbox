<?php

namespace Http\Admin\System\Tests\System;

use App\Tests\Feature\Traits\ShowFeatureTestTrait;

class SystemTest extends _TestCase
{
    use ShowFeatureTestTrait;

    public function test_information()
    {
        $this->processShow('information');
    }
}
