<?php

namespace Tests\Feature\Admin\Product\Product;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    protected array $requestQuery = [
        '_method' => self::REQUEST_METHOD_PATCH,
    ];

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'category_id' => 1,
            'brand_id' => 1,
            'model_number' => 'Model 1',
            'sku' => 'SKU 1',
            'date_eol' => date('d.m.Y'),
        ];

        $this->requestFiles = [
            'images_list' => [
                UploadedFile::fake()->create('image_1.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image_2.jpg', 100, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
