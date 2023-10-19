<?php

namespace Http\Admin\Feedback\Tests\Callback;

use App\Testing\Feature\PostmanTestCase;

class _TestCase extends PostmanTestCase
{
    public int $userId = 1;

    public string $requestUrl = 'admin/feedback/callback';
}
