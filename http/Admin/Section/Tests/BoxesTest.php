<?php

namespace Http\Admin\Section\Tests;

use App\Tests\Feature\Helpers\FormHelper;

class BoxesTest extends _TestCase
{
    public function test_show()
    {
        $this->requestUrl .= '/boxes';
        $this->requestMethod = self::REQUEST_METHOD_GET;

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_update()
    {
        $this->requestUrl .= '/boxes';
        $this->requestMethod = self::REQUEST_METHOD_PATCH;

        $this->requestBody = [
            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
