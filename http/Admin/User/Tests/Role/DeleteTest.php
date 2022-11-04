<?php

namespace Http\Admin\User\Tests\Role;

class DeleteTest extends _TestCase
{
    public function test_delete()
    {
        $this->processDelete('3');
    }

    public function test_error___Undeletable()
    {
        $this->processDelete('1', 400);
    }
}
