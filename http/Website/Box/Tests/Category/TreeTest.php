<?php

namespace Http\Website\Box\Tests\Category;

class TreeTest extends _TestCase
{
    public string $requestUrl = 'website/box/category-tree';

    public function test_success(): void
    {
        $this->sendRequest();
    }
}
