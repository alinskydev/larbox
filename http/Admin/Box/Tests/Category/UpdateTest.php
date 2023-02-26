<?php

namespace Http\Admin\Box\Tests\Category;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: '2',
            body: [
                'name' => FormHelper::localized('Category 1'),

                ...FormHelper::seoMeta(),
            ],
        );
    }
}
