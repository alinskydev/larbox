<?php

namespace Http\Admin\Box\Tests\Category;

class TreeTest extends _TestCase
{
    public string $requestUrl = 'admin/box/category-tree';
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_success(): void
    {
        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
