<?php

namespace Http\Website\Box\Tests\Brand;

/**
 * @depends Http\Website\Box\Tests\Brand\UpdateTest::test_success
 */
class DeleteTest extends _TestCase
{
    public function test_delete(): void
    {
        $this->processDelete('brand-2');
    }

    public function test_error___Not_your_record(): void
    {
        $this->processDelete('brand-1', 404);
    }
}
