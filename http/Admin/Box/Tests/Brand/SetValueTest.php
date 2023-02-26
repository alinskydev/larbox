<?php

namespace Http\Admin\Box\Tests\Brand;

class SetValueTest extends _TestCase
{
    public function test_activate(): void
    {
        $this->sendRequest(
            method: 'PATCH',
            path: '1/set-active/1',
        );
    }

    public function test_deactivate(): void
    {
        $this->sendRequest(
            method: 'PATCH',
            path: '1/set-active/0',
        );
    }
}
