<?php

namespace Http\Admin\User\Tests\Notification;

class CreateTest extends _TestCase
{
    public function test_success()
    {
        $this->processPost(
            body: [
                'user_query' => '?filter[common]=Admin&filter[role_id]=1',
                'type' => 'message',
                'text' => 'Text 3',
            ],
            assertStatus: 201,
        );
    }
}
