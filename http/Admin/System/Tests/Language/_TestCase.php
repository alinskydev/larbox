<?php

namespace Http\Admin\System\Tests\Language;

use App\Tests\Feature\PostmanTestCase;
use Modules\System\Search\LanguageSearch;

class _TestCase extends PostmanTestCase
{
    protected array $authHeaders = LARBOX_TEST_ADMIN_HEADERS;

    protected string $requestUrl = 'admin/system/language';

    protected string $searchClass = LanguageSearch::class;
}
