<?php

namespace Http\Admin\System\Tests\Language;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\System\Search\LanguageSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = LanguageSearch::class;

    public function test_available_filters()
    {
        $this->processAvailableFilters([
            'id' => 1,
            'name' => 'русский',
            'code' => 'ru',
            'is_active' => 1,
            'is_main' => 1,
        ]);
    }

    public function test_available_sortings()
    {
        $this->processAvailableSortings();
    }

    public function test_pagination()
    {
        $this->processPagination();
    }
}
