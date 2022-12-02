<?php

namespace Http\Admin\Box\Tests\Tag;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processPost(
            body: [
                'name' => 'Tag 3',
            ],
            assertStatus: 201,
        );
    }
}
