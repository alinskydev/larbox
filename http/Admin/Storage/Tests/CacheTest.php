<?php

namespace Http\Admin\Storage\Tests;

class CacheTest extends _TestCase
{
    public function test_delete_thumbs()
    {
        $this->requestUrl .= '/cache/delete-thumbs';
        $this->requestMethod = self::REQUEST_METHOD_DELETE;

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
