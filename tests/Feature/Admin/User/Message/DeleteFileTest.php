<?php

namespace Tests\Feature\Admin\User\Message;

class DeleteFileTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_DELETE;

    public function test_first_item_from_files_list()
    {
        $this->requestUrl .= '/1/delete-file/files_list/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }
}
