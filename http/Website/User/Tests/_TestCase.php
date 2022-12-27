<?php

namespace Http\Website\User\Tests;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected int $userId = 3;

    public string $requestUrl = 'website/user';
}
