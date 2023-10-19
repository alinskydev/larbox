<?php

namespace Http\Admin\System\Tests\Settings;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    public int $userId = 1;

    public string $requestUrl = 'admin/system/settings';
}
