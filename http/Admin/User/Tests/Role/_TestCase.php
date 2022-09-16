<?php

namespace Http\Admin\User\Tests\Role;

use App\Tests\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_ADMIN_HEADERS;

    public string $requestUrl = 'admin/user/role';
}
