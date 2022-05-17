<?php

namespace Tests\Feature\Public\Shop\Contact;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'first_name' => 'First name 3',
            'second_name' => 'Second name 3',
            'last_name' => 'Last name 3',
            'position' => 'Position 3',
            'phone' => 'Phone 3',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
