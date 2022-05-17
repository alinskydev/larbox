<?php

namespace Tests\Feature\Admin\Product\Category;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'name' => [
                'ru' => 'Category 1 ru',
                'uz' => 'Category 1 uz',
            ],
            'specifications' => [
                1, 2,
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
