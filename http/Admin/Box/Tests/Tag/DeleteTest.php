<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Tests\Feature\Traits\DeleteFeatureTestTrait;

class DeleteTest extends _TestCase
{
    use DeleteFeatureTestTrait;

    public function test_delete()
    {
        $this->processDelete();
    }

    public function test_restore()
    {
        $this->processRestore();
    }
}
