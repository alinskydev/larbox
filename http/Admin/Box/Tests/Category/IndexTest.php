<?php

namespace Http\Admin\Box\Tests\Category;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\Box\Search\CategorySearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = CategorySearch::class;

    public function test_available_filters(): void
    {
        $this->processAvailableFilters([
            'id' => 3,
            'depth' => 1,
            'name' => 'category',
        ]);
    }

    public function test_available_showings(): void
    {
        $this->processAvailableShowings([
            'boxes_count',
        ]);
    }

    public function test_show_with_deleted(): void
    {
        $this->processShowWithDeleted();
    }

    public function test_show_only_deleted(): void
    {
        $this->processShowOnlyDeleted();
    }

    public function test_pagination(): void
    {
        $this->processPagination();
    }
}
