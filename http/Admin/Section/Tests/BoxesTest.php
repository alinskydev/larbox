<?php

namespace Http\Admin\Section\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class BoxesTest extends _TestCase
{
    public function test_show(): void
    {
        $this->sendRequest(
            path: 'boxes',
        );
    }

    public function test_update(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: 'boxes',
            body: [
                ...FormHelper::seoMeta(),
            ],
        );
    }
}
