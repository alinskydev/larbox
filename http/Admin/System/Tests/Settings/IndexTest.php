<?php

namespace Http\Admin\System\Tests\Settings;

use App\Tests\Feature\Traits\ShowFeatureTestTrait;

class IndexTest extends _TestCase
{
    use ShowFeatureTestTrait;

    public function test_success()
    {
        $this->processShow('');
    }
}
