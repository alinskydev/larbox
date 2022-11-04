<?php

namespace Http\Admin\Section\Tests;

use App\Tests\Feature\Traits\ShowFeatureTestTrait;
use App\Helpers\Test\Feature\FormHelper;

class BoxesTest extends _TestCase
{
    use ShowFeatureTestTrait;

    public function test_show()
    {
        $this->processShow('boxes');
    }

    public function test_update()
    {
        $this->requestUrl .= '/boxes';
        $this->requestMethod = self::REQUEST_METHOD_PUT;

        $this->requestBody = [
            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
