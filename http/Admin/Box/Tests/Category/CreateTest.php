<?php

namespace Http\Admin\Box\Tests\Category;

use App\Helpers\Test\Feature\FormHelper;

class CreateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => FormHelper::localized('Category 3'),

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
