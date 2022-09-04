<?php

namespace Http\Admin\Storage\Tests;

use App\Helpers\Test\Feature\FormHelper;

class UploadTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_file()
    {
        $this->requestUrl .= '/upload/file';

        $this->requestBody = [
            'file' => FormHelper::file(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_media()
    {
        $this->requestUrl .= '/upload/media';

        $this->requestBody = [
            'file' => FormHelper::file(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
