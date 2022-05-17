<?php

namespace Tests\Feature\Admin\Shop\Shop;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'agent_id' => '2',
            'city_id' => '1',
            'company_id' => '1',
            'name' => 'Shop 3',
            'address' => 'Address 3',
            'has_credit_line' => '1',
            'location' => [
                '22.56',
                '33.28',
            ],

            'suppliers' => [1, 2],
            'contacts' => [1, 2],
            'brands' => [1, 2],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
