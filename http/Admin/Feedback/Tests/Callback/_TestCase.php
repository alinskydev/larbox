<?php

namespace Http\Admin\Feedback\Tests\Callback;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    protected int $userId = 1;

    public string $requestUrl = 'admin/feedback/callback';
}
