<?php

namespace Http\Admin\User\Tests\Notification;

class SeeAllTest extends _TestCase
{
    public function test_success()
    {
        $this->processPatch('see-all');
    }
}
