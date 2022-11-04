<?php

namespace Http\Admin\Box\Tests\Brand;

class DeleteTest extends _TestCase
{
    public function test_delete()
    {
        $this->processDelete();
    }

    public function test_restore()
    {
        $this->processRestore();
    }
}
