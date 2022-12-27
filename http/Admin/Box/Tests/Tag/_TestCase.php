<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Testing\Feature\PostmanTestCase;
use Modules\Box\Search\TagSearch;

class _TestCase extends PostmanTestCase
{
    protected int $userId = 1;

    public string $requestUrl = 'admin/box/tag';
}
