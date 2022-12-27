<?php

namespace Http\Admin\User\Tests\User;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected int $userId = 1;

    public string $requestUrl = 'admin/user/user';
}
