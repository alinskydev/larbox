<?php

namespace Http\Admin\Box\Tests\Box;

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
