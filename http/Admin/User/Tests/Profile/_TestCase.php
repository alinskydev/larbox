<?php

namespace Http\Admin\User\Tests\Profile;

use App\Tests\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_ADMIN_HEADERS;

    protected string $requestUrl = 'admin/user/profile';
}
