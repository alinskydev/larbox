<?php

namespace Http\Website\Box\Tests\Brand;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\Box\Search\BrandSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = BrandSearch::class;

    public function test_available_relations(): void
    {
        $this->processAvailableRelations();
    }

    public function test_available_filters(): void
    {
        $this->processAvailableFilters([
            'id' => 1,
            'name' => 'brand',
            'show_on_the_home_page' => 1,
            'is_active' => 1,
        ]);
    }

    public function test_available_sortings(): void
    {
        $this->processAvailableSortings();
    }

    public function test_available_showings(): void
    {
        $this->processAvailableShowings([
            'boxes_count',
        ]);
    }

    public function test_pagination(): void
    {
        $this->processPagination();
    }
}
