<?php

namespace Http\Admin\System\Tests\Settings;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'admin_email' => 'info@local.host',
            'favicon' => UploadedFile::fake()->create('image_1.jpg', 100, 'image/jpeg'),
            'logo' => UploadedFile::fake()->create('image_2.jpg', 100, 'image/jpeg'),
            'project_name' => 'Larbox',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
