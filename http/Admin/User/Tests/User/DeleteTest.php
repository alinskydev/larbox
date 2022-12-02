<?php

namespace Http\Admin\User\Tests\User;

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

    public function test_error___Undeletable(): void
    {
        $this->processDelete('1', 400);
    }
}
