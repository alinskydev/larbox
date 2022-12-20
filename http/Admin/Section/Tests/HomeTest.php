<?php

namespace Http\Admin\Section\Tests;

class HomeTest extends _TestCase
{
    public function test_show(): void
    {
        $this->processShow('home');
    }

    public function test_update(): void
    {
        $this->processUpdate(
            path: 'home',
            body: [
                'first_text_1' => 'Text 1',
                'first_text_1_localized' => $this->formHelper::localized('Text 1'),
                'first_text_2' => 'Text 2',
                'first_text_2_localized' => $this->formHelper::localized('Text 2'),
                'first_text_3' => 'Text 3',
                'first_text_3_localized' => $this->formHelper::localized('Text 3'),

                'second_image_desktop' => $this->formHelper::files(),
                'second_image_tablet' => $this->formHelper::files(),
                'second_image_mobile' => $this->formHelper::files(),
                'second_images_list' => $this->formHelper::files(quantity: 2),

                'relations_1' => $this->formHelper::multiply(
                    range(1, 2),
                    fn ($index) => [
                        'text' => "Text $index",
                        'image' => $this->formHelper::files(),
                    ],
                ),

                'relations_2' => $this->formHelper::multiply(
                    range(1, 2),
                    fn ($index) => [
                        'text_localized' => $this->formHelper::localized("Text $index"),
                        'images_list' => $this->formHelper::files(quantity: 2),
                    ],
                ),

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
        );
    }
}
