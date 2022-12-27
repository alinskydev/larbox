<?php

namespace Http\Website\Box\Tests\Category;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected int $userId = 3;

    public string $requestUrl = 'website/box/category';
}
