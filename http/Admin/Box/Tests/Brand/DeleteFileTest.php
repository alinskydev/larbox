<?php

namespace Http\Admin\Box\Tests\Brand;

use App\Tests\Feature\Traits\DeleteFeatureTestTrait;

class DeleteFileTest extends _TestCase
{
    use DeleteFeatureTestTrait;

    public function test_file()
    {
        $this->processDelete('1/delete-file/file');
    }

    public function test_first_from_files_list()
    {
        $this->processDelete('1/delete-file/files_list/0');
    }
}
