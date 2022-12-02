<?php

namespace Http\Admin\System\Tests\Language;

class SetValueTest extends _TestCase
{
    public function test_set_main(): void
    {
        $this->processPatch('1/set-main/1');
    }

    public function test_activate(): void
    {
        $this->processPatch('2/set-active/1');
    }

    public function test_deactivate(): void
    {
        $this->processPatch('2/set-active/0');
    }

    public function test_deactivation_error___Main_or_current_language(): void
    {
        $this->processPatch('1/set-active/0', assertStatus: 400);
    }
}
