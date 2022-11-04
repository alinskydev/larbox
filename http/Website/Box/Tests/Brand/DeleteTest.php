<?php

namespace Http\Website\Box\Tests\Brand;

use App\Tests\Feature\Traits\DeleteFeatureTestTrait;

/**
 * @depends Http\Website\Box\Tests\Brand\UpdateTest::test_success
 */
class DeleteTest extends _TestCase
{
    use DeleteFeatureTestTrait;

    public function test_delete()
    {
        $this->processDelete('brand-2');
    }

    public function test_error___Not_your_record()
    {
        $this->processDelete('brand-1', 404);
    }
}
