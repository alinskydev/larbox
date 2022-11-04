<?php

namespace Http\Admin\Section\Tests;

use App\Tests\Feature\Traits\ShowFeatureTestTrait;
use App\Helpers\Test\Feature\FormHelper;

class ContactTest extends _TestCase
{
    use ShowFeatureTestTrait;

    public function test_show()
    {
        $this->processShow('contact');
    }

    public function test_update()
    {
        $this->requestUrl .= '/contact';
        $this->requestMethod = self::REQUEST_METHOD_PUT;

        $this->requestBody = [
            'socials_facebook' => '',
            'socials_instagram' => '',
            'socials_youtube' => '',

            'branches' => FormHelper::multiply(
                range(1, 2),
                fn ($index) => [
                    'name' => "Name $index",
                    'phones' => [
                        "+998 00 000 00 {$index}1",
                        "+998 00 000 00 {$index}2",
                    ],
                    'description' => FormHelper::localized("Description $index"),
                ],
            ),

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
