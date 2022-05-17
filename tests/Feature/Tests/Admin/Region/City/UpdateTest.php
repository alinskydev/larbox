<?php

namespace Tests\Feature\Admin\Region\City;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'region_id' => '1',
            'name' => [
                'ru' => 'City 1 ru',
                'uz' => 'City 1 uz',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
