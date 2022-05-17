<?php

namespace Tests\Feature\Admin\Product\Product;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'category_id' => 1,
            'brand_id' => 1,
            'model_number' => 'Model 3',
            'sku' => 'SKU 3',
            'date_eol' => date('d.m.Y'),
        ];

        $this->requestFiles = [
            'images_list' => [
                UploadedFile::fake()->create('image_1.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image_2.jpg', 100, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
