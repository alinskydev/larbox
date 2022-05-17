<?php

namespace Tests\Feature\Admin\Shop\Contact;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'first_name' => 'First name 1',
            'second_name' => 'Second name 1',
            'last_name' => 'Last name 1',
            'position' => 'Position 1',
            'phone' => 'Phone 1',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
