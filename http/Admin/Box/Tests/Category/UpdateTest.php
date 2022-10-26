<?php

namespace Http\Admin\Box\Tests\Category;

use App\Helpers\Test\Feature\FormHelper;

class UpdateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PUT;

    public function test_success()
    {
        $this->requestUrl .= '/2';

        $this->requestBody = [
            'name' => FormHelper::localized('Category 1'),

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
