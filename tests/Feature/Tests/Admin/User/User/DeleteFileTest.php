<?php

namespace Tests\Feature\Tests\Admin\User\User;

class DeleteFileTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_DELETE;

    public function test_image()
    {
        $this->requestUrl .= '/1/delete-file/image';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }
}
