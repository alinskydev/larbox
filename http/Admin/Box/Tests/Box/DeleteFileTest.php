<?php

namespace Http\Admin\Box\Tests\Box;

use App\Tests\Feature\Traits\DeleteFeatureTestTrait;

class DeleteFileTest extends _TestCase
{
    use DeleteFeatureTestTrait;

    public function test_image()
    {
        $this->processDelete('1/delete-file/image');
    }

    public function test_first_from_images_list()
    {
        $this->processDelete('1/delete-file/images_list/0');
    }
}
