<?php

namespace Http\Admin\Box\Tests\Tag;

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
