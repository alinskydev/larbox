<?php

namespace Http\Admin\User\Tests\User;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    public int $userId = 1;

    public string $requestUrl = 'admin/user/user';
}
