<?php

namespace Http\Admin\System\Tests\Language;

use App\Tests\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_AUTH_ADMIN_HEADERS;

    public string $requestUrl = 'admin/system/language';
}
