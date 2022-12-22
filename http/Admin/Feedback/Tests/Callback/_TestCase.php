<?php

namespace Http\Admin\Feedback\Tests\Callback;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_AUTH_ADMIN_HEADERS;

    public string $requestUrl = 'admin/feedback/callback';
}
