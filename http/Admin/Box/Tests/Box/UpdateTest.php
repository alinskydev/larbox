<?php

namespace Http\Admin\Box\Tests\Box;

class UpdateTest extends _TestCase
{
    public function test_success()
    {
        $this->processUpdate(
            body: [
                'brand_id' => 1,
                'name' => $this->formHelper::localized('Box 1'),
                'description' => $this->formHelper::localized('Description 1'),
                'price' => 2000,
                'date' => date(LARBOX_FORMAT_DATE),
                'datetime' => date(LARBOX_FORMAT_DATETIME),
                'image' => $this->formHelper::file(),
                'images_list' => [
                    $this->formHelper::file(),
                    $this->formHelper::file(),
                ],

                'categories' => [6, 7],
                'tags' => [1, 2],

                'variations' => $this->formHelper::multiply(
                    range(1, 2),
                    fn ($index) => [
                        'id' => $index,
                        'name' => $this->formHelper::localized("Variation $index"),
                        'date' => date(LARBOX_FORMAT_DATE),
                        'datetime' => date(LARBOX_FORMAT_DATETIME),
                        'image' => $this->formHelper::file(),
                        'images_list' => [
                            $this->formHelper::file(),
                            $this->formHelper::file(),
                        ],
                    ],
                ),

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
        );
    }
}
