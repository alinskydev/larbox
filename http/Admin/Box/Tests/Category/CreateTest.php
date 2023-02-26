<?php

namespace Http\Admin\Box\Tests\Category;

use App\Testing\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            body: [
                'name' => FormHelper::localized('Category 3'),

                ...FormHelper::seoMeta(),
            ],
            assertStatus: 201,
        );
    }
}
