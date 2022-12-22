<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Testing\Feature\PostmanTestCase;
use Modules\Box\Search\TagSearch;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_AUTH_ADMIN_HEADERS;

    public string $requestUrl = 'admin/box/tag';
}
