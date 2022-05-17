<?php

namespace Tests\Feature\Admin\Region\Region;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'name' => [
                'ru' => 'Region 1 ru',
                'uz' => 'Region 1 uz',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
