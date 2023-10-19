<?php

namespace Http\Admin\Box\Tests\Box;

use App\Testing\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            body: [
                'brand_id' => 1,
                'name' => FormHelper::localized('Box 3'),
                'description' => FormHelper::localized('Description 3'),
                'price' => 9300,
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                ...FormHelper::deleteableFiles(
                    field: 'image',
                    files: FormHelper::files(),
                    oldKeys: [],
                ),
                ...FormHelper::deleteableFiles(
                    field: 'images_list',
                    files: FormHelper::files(quantity: 2),
                    oldKeys: [],
                ),

                'categories' => [6, 8],
                'tags' => [1, 2],

                'variations' => array_map(
                    fn ($index) => [
                        'name' => FormHelper::localized("Variation $index"),
                        ...FormHelper::deleteableFiles(
                            field: 'image',
                            files: FormHelper::files(),
                            oldKeys: [],
                        ),
                    ],
                    range(1, 2),
                ),

                ...FormHelper::seoMeta(),
            ],
        );
    }
}
