<?php

namespace Http\Admin\User\Tests\User;

class DeleteFileTest extends _TestCase
{
    public function test_image()
    {
        $this->processDelete('1/delete-file/image');
    }
}
