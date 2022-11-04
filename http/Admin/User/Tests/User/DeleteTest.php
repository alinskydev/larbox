<?php

namespace Http\Admin\User\Tests\User;

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

    public function test_error___Undeletable()
    {
        $this->processDelete('1', 400);
    }
}
