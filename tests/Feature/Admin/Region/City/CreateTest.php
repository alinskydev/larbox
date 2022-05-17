<?php

namespace Tests\Feature\Admin\Region\City;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'region_id' => '1',
            'name' => [
                'ru' => 'City 3 ru',
                'uz' => 'City 3 uz',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
