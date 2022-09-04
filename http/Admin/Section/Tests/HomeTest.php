<?php

namespace Http\Admin\Section\Tests;

use App\Helpers\Test\Feature\FormHelper;

class HomeTest extends _TestCase
{
    public function test_show()
    {
        $this->requestUrl .= '/home';
        $this->requestMethod = self::REQUEST_METHOD_GET;

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_update()
    {
        $this->requestUrl .= '/home';
        $this->requestMethod = self::REQUEST_METHOD_PUT;

        $this->requestBody = [
            'first_text_1' => 'Text 1',
            'first_text_1_localized' => FormHelper::localized('Text 1'),
            'first_text_2' => 'Text 2',
            'first_text_2_localized' => FormHelper::localized('Text 2'),
            'first_text_3' => 'Text 3',
            'first_text_3_localized' => FormHelper::localized('Text 3'),

            'second_image' => FormHelper::file(),
            'second_images_list' => [
                FormHelper::file(),
                FormHelper::file(),
            ],
            'second_image_desktop' => FormHelper::localizedFile(),
            'second_image_tablet' => FormHelper::localizedFile(),
            'second_image_mobile' => FormHelper::localizedFile(),

            'relations_1' => FormHelper::multiply(
                range(1, 2),
                fn ($index) => [
                    'text' => "Text $index",
                    'image' => FormHelper::file(),
                    'images_list' => [
                        FormHelper::file(),
                        FormHelper::file(),
                        FormHelper::file(),
                    ],
                ],
            ),

            'relations_2' => FormHelper::multiply(
                range(1, 2),
                fn ($index) => [
                    'text_localized' => FormHelper::localized("Text $index"),
                    'image_desktop' => FormHelper::localizedFile(),
                    'image_tablet' => FormHelper::localizedFile(),
                    'image_mobile' => FormHelper::localizedFile(),
                ],
            ),

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
