<?php

namespace Http\Admin\Box\Tests\Brand;

class SetValueTest extends _TestCase
{
    public function test_activate()
    {
        $this->processPatch('1/set-active/1');
    }

    public function test_deactivate()
    {
        $this->processPatch('1/set-active/0');
    }
}
