<?php

namespace Http\Common\System\Tests;

class SystemTest extends _TestCase
{
    public function test_information()
    {
        $this->processShow('information');
    }

    public function test_enums()
    {
        $this->processShow('enums');
    }
}
