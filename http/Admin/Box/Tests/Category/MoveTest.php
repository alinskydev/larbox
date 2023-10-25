<?php

namespace Http\Admin\Box\Tests\Category;

class MoveTest extends _TestCase
{
    public function test_before(): void
    {
        $this->sendRequest(
            method: 'PATCH',
            path: 'move',
            body: [
                'id' => 8,
                'node_id' => 2,
                'type' => 'before',
            ],
        );
    }

    public function test_after(): void
    {
        $this->sendRequest(
            method: 'PATCH',
            path: 'move',
            body: [
                'id' => 2,
                'node_id' => 8,
                'type' => 'after',
            ],
        );
    }

    public function test_into(): void
    {
        $this->sendRequest(
            method: 'PATCH',
            path: 'move',
            body: [
                'id' => 2,
                'node_id' => 8,
                'type' => 'into',
            ],
        );
    }
}
