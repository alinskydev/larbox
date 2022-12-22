<?php

namespace Http\Admin\User\Tests\Profile;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_AUTH_ADMIN_HEADERS;

    public string $requestUrl = 'admin/user/profile';
}
