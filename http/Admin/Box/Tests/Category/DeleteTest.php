<?php

namespace Http\Admin\Box\Tests\Category;

use App\Tests\Feature\Traits\DeleteFeatureTestTrait;

class DeleteTest extends _TestCase
{
    use DeleteFeatureTestTrait;

    public function test_delete()
    {
        $this->processDelete('2');
    }

    public function test_restore()
    {
        $this->processRestore('2/restore');
    }
}
