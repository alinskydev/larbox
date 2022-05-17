<?php

namespace Tests\Feature\Admin\Region\Country;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => [
                'ru' => 'Country 3 ru',
                'uz' => 'Country 3 uz',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
