<?php

namespace Tests\Feature\Public\Shop\Supplier;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'country_id' => '1',
            'short_name' => 'Short name 3',
            'full_name' => 'Full name 3',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
