<?php

namespace Tests\Feature\Admin\Shop\Company;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => 'Company 3',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
