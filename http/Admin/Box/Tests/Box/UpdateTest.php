<?php

namespace Http\Admin\Box\Tests\Box;

use App\Tests\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PUT;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'brand_id' => 1,
            'name' => FormHelper::localized('Box 1'),
            'description' => FormHelper::localized('Description 1'),
            'price' => 2000,
            'date' => date(LARBOX_FORMAT_DATE),
            'datetime' => date(LARBOX_FORMAT_DATETIME),
            'image' => FormHelper::file(),
            'images_list' => [
                FormHelper::file(),
                FormHelper::file(),
            ],

            'tags' => [1, 2],

            'variations' => FormHelper::multiply(
                range(1, 2),
                fn ($index) => [
                    'id' => $index,
                    'name' => FormHelper::localized("Variation $index"),
                    'date' => date(LARBOX_FORMAT_DATE),
                    'datetime' => date(LARBOX_FORMAT_DATETIME),
                    'image' => FormHelper::file(),
                    'images_list' => [
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
