<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Tests\Feature\PostmanTestCase;
use Modules\Box\Search\TagSearch;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_ADMIN_HEADERS;

    protected string $requestUrl = 'admin/box/tag';

    protected string $searchClass = TagSearch::class;
}
