<?php

namespace Tests\Feature\Tests\Admin\System\Language;

use Tests\Feature\PostmanTestCase;
use Tests\Feature\Config\AuthConfig;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = AuthConfig::ADMIN_HEADERS;

    protected string $requestUrl = 'admin/system/language';
}
