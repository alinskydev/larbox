<?php

namespace Http\Website\Box\Tests\Category;

class ShowTest extends _TestCase
{
    public function test_full_slug_1(): void
    {
        $this->sendRequest(
            path: 'category-1-ru/category-1-1-ru/leaf-1-ru',
        );
    }

    public function test_full_slug_2(): void
    {
        $this->sendRequest(
            path: 'category-1-ru/category-1-2-ru/leaf-1-ru',
        );
    }
}
