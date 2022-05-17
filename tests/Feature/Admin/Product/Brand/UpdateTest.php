<?php

namespace Tests\Feature\Admin\Product\Brand;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'name' => 'Brand 1',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
