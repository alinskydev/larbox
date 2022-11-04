<?php

namespace Http\Website\Box\Tests\Category;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\Box\Search\CategorySearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = CategorySearch::class;

    public function test_available_filters()
    {
        $this->processAvailableFilters([
            'id' => 3,
            'depth' => 2,
            'name' => 'category',
        ]);
    }

    public function test_available_sortings()
    {
        $this->processAvailableSortings();
    }

    public function test_available_showings()
    {
        $this->processAvailableShowings([
            'boxes_count',
        ]);
    }

    public function test_pagination()
    {
        $this->processPagination();
    }
}
