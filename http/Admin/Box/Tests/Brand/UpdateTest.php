<?php

namespace Http\Admin\Box\Tests\Brand;

use App\Tests\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PUT;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'name' => 'Brand 1',
            'show_on_the_home_page' => '1',
            'file' => FormHelper::file(),
            'files_list' => [
                FormHelper::file(),
                FormHelper::file(),
            ],

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
