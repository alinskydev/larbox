<?php

namespace Http\Website\Box\Tests\Brand;

class ShowTest extends _TestCase
{
    public function test_success()
    {
        $this->processShow('brand-2');
    }

    public function test_error___Not_your_record()
    {
        $this->processShow('brand-1', 404);
    }
}
