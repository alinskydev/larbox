<?php

namespace Http\Admin\Box\Tests\Brand;

class DeleteFileTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_DELETE;

    public function test_file()
    {
        $this->requestUrl .= '/1/delete-file/file';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_first_from_files_list()
    {
        $this->requestUrl .= '/1/delete-file/files_list/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
