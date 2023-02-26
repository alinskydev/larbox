<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: '1',
            body: [
                'name' => 'Tag 1',
            ],
        );
    }
}
