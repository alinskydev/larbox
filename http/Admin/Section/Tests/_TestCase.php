<?php

namespace Http\Admin\Section\Tests;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected int $userId = 1;

    public string $requestUrl = 'admin/section';
}
