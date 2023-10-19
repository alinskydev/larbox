<?php

namespace Http\Website\User\Tests;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    public int $userId = 3;

    public string $requestUrl = 'website/user';
}
