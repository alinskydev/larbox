<?php

namespace Tests\Feature\Admin\Report\Report;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'shop_id' => '1',
            'type' => 'ds',
            'number' => 'Number 3',
            'date_period_type' => 'week',
            'date_period_from' => date('d.m.Y', strtotime('-1 week')),
            'products' => [
                [
                    'product_id' => '1',
                    'supplier_id' => '1',
                    'quantity' => '1',
                ],
                [
                    'product_id' => '1',
                    'variation_id' => '1',
                    'supplier_id' => '1',
                    'quantity' => '2',
                ],
                [
                    'product_id' => '1',
                    'variation_id' => '2',
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
        $this->response->assertStatus(201);
    }
}
