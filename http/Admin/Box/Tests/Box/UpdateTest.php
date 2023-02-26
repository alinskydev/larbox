<?php

namespace Http\Admin\Box\Tests\Box;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: '1',
            body: [
                'brand_id' => 1,
                'name' => FormHelper::localized('Box 1'),
                'description' => FormHelper::localized('Description 1'),
                'price' => 2000,
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                ...FormHelper::deleteableFiles(
                    field: 'image',
                    files: FormHelper::files(),
                    oldKeys: [0],
                ),
                ...FormHelper::deleteableFiles(
                    field: 'images_list',
                    files: FormHelper::files(quantity: 2),
                    oldKeys: [0, 1],
                ),

                'categories' => [6, 7],
                'tags' => [1, 2],

                'variations' => array_map(
                    fn ($index) => [
                        'id' => $index,
                        'name' => FormHelper::localized("Variation $index"),
                        ...FormHelper::deleteableFiles(
                            field: 'image',
                            files: FormHelper::files(),
                            oldKeys: [0],
                        ),
                    ],
                    range(1, 2),
                ),

                ...FormHelper::seoMeta(),
            ],
        );
    }
}
