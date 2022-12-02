<?php

namespace Http\Admin\User\Tests\Notification;

class SeeAllTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processPatch('see-all');
    }
}
