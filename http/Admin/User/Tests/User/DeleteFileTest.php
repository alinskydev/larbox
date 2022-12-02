<?php

namespace Http\Admin\User\Tests\User;

class DeleteFileTest extends _TestCase
{
    public function test_image(): void
    {
        $this->processDelete('1/delete-file/image');
    }
}
