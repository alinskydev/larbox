<?php

namespace Http\Admin\Box\Tests\Brand;

class DeleteFileTest extends _TestCase
{
    public function test_file(): void
    {
        $this->processDelete('1/delete-file/file');
    }

    public function test_first_from_files_list(): void
    {
        $this->processDelete('1/delete-file/files_list/0');
    }
}
