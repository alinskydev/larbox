<?php

namespace Http\Admin\Feedback\Tests\Callback;

class SetValueTest extends _TestCase
{
    public function test_change_status(): void
    {
        $this->processPatch('1/set-status/in_process');
    }
}
