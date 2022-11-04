<?php

namespace Http\Website\Box\Tests\Category;

use App\Tests\Feature\Traits\ShowFeatureTestTrait;

class ShowTest extends _TestCase
{
    use ShowFeatureTestTrait;

    public function test_full_slug_1()
    {
        $this->processShow('category-1-ru/category-1-1-ru/leaf-1-ru');
    }

    public function test_full_slug_2()
    {
        $this->processShow('category-1-ru/category-1-2-ru/leaf-1-ru');
    }
}
