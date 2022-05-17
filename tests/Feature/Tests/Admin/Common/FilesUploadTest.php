<?php

namespace Tests\Feature\Tests\Admin\Common;

use Illuminate\Http\UploadedFile;

class FilesUploadTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_single()
    {
        $this->requestUrl .= '/file/upload';

        $this->requestBody = [
            'file' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_multiple()
    {
        $this->requestUrl .= '/file/upload';

        $this->requestBody = [
            'files_list' => [
                UploadedFile::fake()->create('image_1.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image_2.jpg', 200, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_combined()
    {
        $this->requestUrl .= '/file/upload';

        $this->requestBody = [
            'file' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            'files_list' => [
                UploadedFile::fake()->create('image_1.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image_2.jpg', 200, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
