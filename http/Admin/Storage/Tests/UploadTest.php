<?php

namespace Http\Admin\Storage\Tests;

use Illuminate\Http\UploadedFile;

class UploadTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_file()
    {
        $this->requestUrl .= '/upload/file';

        $this->requestBody = [
            'file' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_media()
    {
        $this->requestUrl .= '/upload/media';

        $this->requestBody = [
            'file' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
