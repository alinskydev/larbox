<?php

namespace Tests\Feature\Admin\Shop\Supplier;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'country_id' => '1',
            'short_name' => 'Short name 1',
            'full_name' => 'Full name 1',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
