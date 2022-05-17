<?php

namespace Tests\Feature\Tests\Admin\System\Language;

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
            'name' => 'Русский',
        ];

        $this->requestFiles = [
            'image' => UploadedFile::fake()->create('image.jpg', 100, 'image/jpeg'),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
