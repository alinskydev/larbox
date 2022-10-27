<?php

namespace Http\Website\Box\Tests\Category;

class ShowTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_full_slug_1()
    {
        $this->requestUrl = 'website/box/category-show/category-1/category-1-1/leaf-1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_full_slug_2()
    {
        $this->requestUrl = 'website/box/category-show/category-1/category-1-2/leaf-1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
