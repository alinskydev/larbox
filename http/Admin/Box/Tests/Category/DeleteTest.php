<?php

namespace Http\Admin\Box\Tests\Category;

class DeleteTest extends _TestCase
{
    public function test_delete(): void
    {
        $this->processDelete();
    }

    public function test_restore(): void
    {
        $this->processRestore();
    }
}
