<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Tests\Feature\PostmanTestCase;
use Modules\Box\Search\TagSearch;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_ADMIN_HEADERS;

    public string $requestUrl = 'admin/box/tag';
}
