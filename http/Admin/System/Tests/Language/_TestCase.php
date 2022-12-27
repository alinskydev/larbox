<?php

namespace Http\Admin\System\Tests\Language;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected int $userId = 1;

    public string $requestUrl = 'admin/system/language';
}
