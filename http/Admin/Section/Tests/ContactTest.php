<?php

namespace Http\Admin\Section\Tests;

use App\Tests\Feature\Helpers\FormHelper;

class ContactTest extends _TestCase
{
    public function test_show()
    {
        $this->requestUrl .= '/contact';
        $this->requestMethod = self::REQUEST_METHOD_GET;

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_update()
    {
        $this->requestUrl .= '/contact';
        $this->requestMethod = self::REQUEST_METHOD_PUT;

        $this->requestBody = [
            'social_facebook' => '',
            'social_instagram' => '',
            'social_youtube' => '',

            'branches' => FormHelper::multiply(
                [1, 2],
                fn ($index) => [
                    'name' => "Name $index",
                    'phone' => "Phone $index",
                    'description' => FormHelper::localized("Description $index"),
                ],
            ),

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
