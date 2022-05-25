<?php

namespace Http\Admin\Box\Tests\Tag;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'name' => 'Tag 1',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
