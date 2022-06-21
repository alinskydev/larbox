<?php

namespace Http\Admin\Box\Tests\Box;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'brand_id' => 1,
            'name' => [
                'ru' => 'Box 3 ru',
                'uz' => 'Box 3 uz',
                'en' => 'Box 3 en',
            ],
            'date' => date('d.m.Y'),
            'datetime' => date('d.m.Y H:i'),
            'image' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            'images_list' => [
                UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
            ],

            'tags' => [1, 2],

            'variations' => [
                [
                    'name' => [
                        'ru' => 'Variation 3 ru',
                        'uz' => 'Variation 3 uz',
                        'en' => 'Variation 3 en',
                    ],
                    'date' => date('d.m.Y'),
                    'datetime' => date('d.m.Y H:i'),
                    'image' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                    'images_list' => [
                        UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                        UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                    ],
                ],
                [
                    'name' => [
                        'ru' => 'Variation 4 ru',
                        'uz' => 'Variation 4 uz',
                        'en' => 'Variation 4 en',
                    ],
                    'date' => date('d.m.Y'),
                    'datetime' => date('d.m.Y H:i'),
                    'image' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                    'images_list' => [
                        UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                        UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
                    ],
                ],
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
