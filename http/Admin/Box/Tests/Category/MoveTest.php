<?php

namespace Http\Admin\Box\Tests\Category;

use App\Helpers\Test\Feature\FormHelper;

class MoveTest extends _TestCase
{
    public string $requestUrl = 'admin/box/category-move';

    public string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestBody = [
            'id' => 3,
            'parent_id' => 1,
            'position' => 0,

            'seo_meta' => FormHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
