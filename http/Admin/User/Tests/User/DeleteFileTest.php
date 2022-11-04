<?php

namespace Http\Admin\User\Tests\User;

use App\Tests\Feature\Traits\DeleteFeatureTestTrait;

class DeleteFileTest extends _TestCase
{
    use DeleteFeatureTestTrait;

    public function test_image()
    {
        $this->processDelete('1/delete-file/image');
    }
}
