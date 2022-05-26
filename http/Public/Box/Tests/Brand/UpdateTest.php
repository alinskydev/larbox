<?php

namespace Http\Public\Box\Tests\Brand;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    protected array $requestQuery = [
        '_method' => self::REQUEST_METHOD_PATCH,
    ];

    public function test_success()
    {
        $this->requestUrl .= '/2';

        $this->requestBody = [
            'name' => 'Brand 2',
            'file' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            'files_list' => [
                UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_error___Not_your_record()
    {
        $this->requestUrl .= '/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(404);
    }
}
