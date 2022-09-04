<?php

namespace Http\Admin\System\Tests\Language;

use App\Services\Test\Feature\IndexFeatureTestService;
use Modules\System\Search\LanguageSearch;

class IndexTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_GET;

    public string $searchClass = LanguageSearch::class;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => 1,
                'name' => 'русский',
                'code' => 'ru',
                'is_active' => 1,
                'is_main' => 1,
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_sortings()
    {
        (new IndexFeatureTestService($this))->availableSortings();
    }

    public function test_pagination()
    {
        (new IndexFeatureTestService($this))->pagination();
    }
}
