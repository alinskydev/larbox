<?php

namespace Tests\Feature\Admin\Product\Category;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => [
                'ru' => 'Category 3 ru',
                'uz' => 'Category 3 uz',
            ],
            'specifications' => [
                1, 2,
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
