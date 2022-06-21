<?php

namespace Http\Admin\User\Tests\User;

use App\Tests\Feature\PostmanTestCase;
use Modules\User\Search\UserSearch;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_ADMIN_HEADERS;

    protected string $requestUrl = 'admin/user/user';

    protected string $searchClass = UserSearch::class;
}
