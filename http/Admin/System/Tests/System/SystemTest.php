<?php

namespace Http\Admin\System\Tests\System;

class SystemTest extends _TestCase
{
    public function test_information()
    {
        $this->processShow('information');
    }
}
