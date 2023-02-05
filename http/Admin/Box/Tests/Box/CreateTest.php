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
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'image' => $this->formHelper::files(),
                'image_old_keys' => '[]',
                'images_list' => $this->formHelper::files(quantity: 2),
                'images_list_old_keys' => '[]',

                'categories' => [6, 8],
                'tags' => [1, 2],

                'variations' => $this->formHelper::multiply(
                    range(1, 2),
                    fn ($index) => [
                        'name' => $this->formHelper::localized("Variation $index"),
                        'image' => $this->formHelper::files(),
                        'image_old_keys' => '[]',
                    ],
                ),

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
            assertStatus: 201,
        );
    }
}
