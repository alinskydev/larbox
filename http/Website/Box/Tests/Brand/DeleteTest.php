<?php

namespace Http\Website\Box\Tests\Brand;

use App\Services\Test\Feature\DeleteFeatureTestService;

/**
 * @depends Http\Website\Box\Tests\Brand\UpdateTest::test_success
 */
class DeleteTest extends _TestCase
{
    public function test_delete()
    {
        (new DeleteFeatureTestService($this))->delete(
            path: 'brand-2',
        );
    }

    public function test_error___Not_your_record()
    {
        (new DeleteFeatureTestService($this))->delete(
            path: 'brand-1',
            assertStatus: 404,
        );
    }
}
