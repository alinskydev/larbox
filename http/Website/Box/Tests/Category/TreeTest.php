<?php

namespace Http\Website\Box\Tests\Category;

class TreeTest extends _TestCase
{
    public string $requestUrl = 'website/box/category-tree';
    public string $requestMethod = 'GET';

    public function test_success(): void
    {
        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
