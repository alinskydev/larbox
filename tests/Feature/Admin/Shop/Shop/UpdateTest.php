<?php

namespace Tests\Feature\Admin\Shop\Shop;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'agent_id' => '2',
            'city_id' => '1',
            'company_id' => '1',
            'name' => 'Shop 1',
            'address' => 'Address 1',
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
        $this->response->assertStatus(200);
    }
}
