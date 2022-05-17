<?php

namespace Tests\Feature\Public\User\Message;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_only_text()
    {
        $this->requestBody = [
            'text' => 'Text 3',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }

    public function test_only_files()
    {
        $this->requestFiles = [
            'files_list' => [
                UploadedFile::fake()->create('image_1.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image_2.jpg', 100, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }

    public function test_combined()
    {
        $this->requestBody = [
            'text' => 'Text 3',
        ];

        $this->requestFiles = [
            'files_list' => [
                UploadedFile::fake()->create('image_1.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image_2.jpg', 100, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }

    public function test_either_text_or_files_required()
    {
        $this->response = $this->sendRequest();
        $this->response->assertStatus(422);
    }
}
