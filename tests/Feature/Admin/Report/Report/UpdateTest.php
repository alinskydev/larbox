<?php

namespace Tests\Feature\Admin\Report\Report;

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
            'shop_id' => '1',
            'type' => 'ds',
            'number' => 'Number 1',
            'date_period_type' => 'week',
            'date_period_from' => date('d.m.Y', strtotime('-2 weeks')),
            'products' => [
                [
                    'id' => '1',
                    'product_id' => '1',
                    'supplier_id' => '1',
                    'quantity' => '2',
                ],
                [
                    'id' => '2',
                    'product_id' => '1',
                    'variation_id' => '1',
                    'supplier_id' => '1',
                    'quantity' => '5',
                ],
            ],
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
