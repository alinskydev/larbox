<?php

namespace Tests\Feature\Admin\Product\Product;

class DeleteFileTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_DELETE;

    public function test_first_item_from_images_list()
    {
        $this->requestUrl .= '/1/delete-file/images_list/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }
}
