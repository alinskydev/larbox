<?php

namespace Http\Admin\Box\Tests\Brand;

use App\Tests\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => 'Brand 3',
            'show_on_the_home_page' => '1',
            'file' => FormHelper::file(),
            'files_list' => [
                FormHelper::file(),
                FormHelper::file(),
            ],

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
