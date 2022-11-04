<?php

namespace Http\Admin\Box\Tests\Category;

class ShowTest extends _TestCase
{
    public function test_success()
    {
        $this->processShow('2');
    }
}
