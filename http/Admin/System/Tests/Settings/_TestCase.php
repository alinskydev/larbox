<?php

namespace Http\Admin\System\Tests\Settings;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected int $userId = 1;

    public string $requestUrl = 'admin/system/settings';
}
