<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Testing\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            body: [
                'name' => 'Tag 3',
            ],
        );
    }
}
