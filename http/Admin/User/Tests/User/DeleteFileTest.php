<?php

namespace Http\Admin\User\Tests\User;

class DeleteFileTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_DELETE;

    public function test_image()
    {
        $this->requestUrl .= '/1/delete-file/image';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
