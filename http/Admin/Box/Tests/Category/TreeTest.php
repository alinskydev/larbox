<?php

namespace Http\Admin\Box\Tests\Category;

class TreeTest extends _TestCase
{
    public string $requestUrl = 'admin/box/category-tree';

    public function test_success(): void
    {
        $this->sendRequest();
    }
}
