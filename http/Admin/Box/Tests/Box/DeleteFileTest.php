<?php

namespace Http\Admin\Box\Tests\Box;

class DeleteFileTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_DELETE;

    public function test_image()
    {
        $this->requestUrl .= '/1/delete-file/image';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_first_from_images_list()
    {
        $this->requestUrl .= '/1/delete-file/images_list/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
