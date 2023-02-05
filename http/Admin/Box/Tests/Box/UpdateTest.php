<?php

namespace Http\Admin\Box\Tests\Box;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processUpdate(
            body: [
                'brand_id' => 1,
                'name' => $this->formHelper::localized('Box 1'),
                'description' => $this->formHelper::localized('Description 1'),
                'price' => 2000,
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'image' => $this->formHelper::files(),
                'image_old_keys' => '[0]',
                'images_list' => $this->formHelper::files(quantity: 2),
                'images_list_old_keys' => '[0, 1]',

                'categories' => [6, 7],
                'tags' => [1, 2],

                'variations' => $this->formHelper::multiply(
                    range(1, 2),
                    fn ($index) => [
                        'id' => $index,
                        'name' => $this->formHelper::localized("Variation $index"),
                        'image' => $this->formHelper::files(),
                        'image_old_keys' => '[0]',
                    ],
                ),

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
        );
    }
}
