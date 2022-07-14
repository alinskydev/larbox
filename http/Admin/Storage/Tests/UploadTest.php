<?php

namespace Http\Admin\Storage\Tests;

use App\Tests\Feature\Helpers\FormHelper;

class UploadTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

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
