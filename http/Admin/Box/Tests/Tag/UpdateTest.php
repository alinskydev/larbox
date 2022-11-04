<?php

namespace Http\Admin\Box\Tests\Tag;

class UpdateTest extends _TestCase
{
    public function test_success()
    {
        $this->processUpdate(
            body: [
                'name' => 'Tag 1',
            ],
        );
    }
}
