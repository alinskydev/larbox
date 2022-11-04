<?php

namespace Http\Admin\User\Tests\Role;

use App\Tests\Feature\Traits\DeleteFeatureTestTrait;

class DeleteTest extends _TestCase
{
    use DeleteFeatureTestTrait;

    public function test_delete()
    {
        $this->processDelete('3');
    }

    public function test_error___Undeletable()
    {
        $this->processDelete('1', 400);
    }
}
