<?php

namespace Http\Admin\Section\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class HomeTest extends _TestCase
{
    public function test_show(): void
    {
        $this->sendRequest(
            path: 'home',
        );
    }

    public function test_update(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: 'home',
            body: [
                'first_text_1' => 'Text 1',
                'first_text_1_localized' => FormHelper::localized('Text 1'),
                'first_text_2' => 'Text 2',
                'first_text_2_localized' => FormHelper::localized('Text 2'),
                'first_text_3' => 'Text 3',
                'first_text_3_localized' => FormHelper::localized('Text 3'),

                'second_image_desktop' => FormHelper::files(),
                'second_image_tablet' => FormHelper::files(),
                'second_image_mobile' => FormHelper::files(),
                'second_images_list' => FormHelper::files(quantity: 2),

                'relations_1' => array_map(
                    fn ($index) => [
                        'text' => "Text $index",
                        'image' => FormHelper::files(),
                    ],
                    range(1, 2),
                ),

                'relations_2' => array_map(
                    fn ($index) => [
                        'text_localized' => FormHelper::localized("Text $index"),
                        'images_list' => FormHelper::files(quantity: 2),
                    ],
                    range(1, 2),
                ),

                ...FormHelper::seoMeta(),
            ],
        );
    }
}
