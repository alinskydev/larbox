<?php

namespace Http\Admin\Box\Tests\Box;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    protected array $requestQuery = [
        '_method' => self::REQUEST_METHOD_PATCH,
    ];

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'brand_id' => 1,
            'name' => [
                'ru' => 'Box 1 ru',
                'uz' => 'Box 1 uz',
                'en' => 'Box 1 en',
            ],
            'date' => date('d.m.Y'),
            'datetime' => date('d.m.Y H:i:s'),
            'image' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            'images_list' => [
                UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            ],

            'tags' => [1, 2],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
