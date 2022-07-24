<?php

namespace Http\Admin\Section\Tests;

use App\Tests\Feature\Helpers\FormHelper;

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
            'welcome_title' => FormHelper::localized('Title'),
            'welcome_slogan' => 'Slogan',
            'welcome_description' => FormHelper::localized('Description'),
            'welcome_image' => FormHelper::file(),
            'images_list' => [
                FormHelper::file(),
                FormHelper::file(),
            ],

            'slider' => FormHelper::multiply(
                [1, 2],
                fn ($index) => [
                    'title' => FormHelper::localized("Title $index"),
                    'subtitle' => FormHelper::localized("Subtitle $index"),
                    'image' => FormHelper::file(),
                ],
            ),

            'portfolio' => FormHelper::multiply(
                [1, 2],
                fn ($index) => [
                    'name' => "Name $index",
                    'description' => FormHelper::localized("Description $index"),
                    'images_list' => [
                        FormHelper::file(),
                        FormHelper::file(),
                        FormHelper::file(),
                    ],
                ],
            ),

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
