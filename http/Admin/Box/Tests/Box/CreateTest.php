<?php

namespace Http\Admin\Box\Tests\Box;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processPost(
            body: [
                'brand_id' => 1,
                'name' => $this->formHelper::localized('Box 3'),
                'description' => $this->formHelper::localized('Description 3'),
                'price' => 9300,
                'date' => date(LARBOX_FORMAT_DATE),
                'datetime' => date(LARBOX_FORMAT_DATETIME),
                'image' => $this->formHelper::file(),
                'images_list' => [
                    $this->formHelper::file(),
                    $this->formHelper::file(),
                ],

                'categories' => [6, 8],
                'tags' => [1, 2],

                'variations' => $this->formHelper::multiply(
                    range(1, 2),
                    fn ($index) => [
                        'name' => $this->formHelper::localized("Variation $index"),
                        'image' => $this->formHelper::file(),
                    ],
                ),

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
            assertStatus: 201,
        );
    }
}
