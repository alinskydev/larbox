<?php

namespace Http\Common\System\Tests;

use App\Tests\Feature\Traits\ShowFeatureTestTrait;

class SystemTest extends _TestCase
{
    use ShowFeatureTestTrait;

    public function test_information()
    {
        $this->processShow('information');
    }

    public function test_enums()
    {
        $this->processShow('enums');
    }
}
