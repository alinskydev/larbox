<?php

namespace Http\Website\Box\Tests\Category;

use App\Testing\Feature\Traits\IndexFeatureTestTrait;
use Modules\Box\Search\CategorySearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = CategorySearch::class;

    public function test_available_filters(): void
    {
        $this->processAvailableFilters([
            'id' => 3,
            'depth' => 2,
            'name' => 'category',
        ]);
    }

    public function test_available_showings(): void
    {
        $this->processIndexRequest([
            'show' => ['boxes_count'],
        ]);
    }

    public function test_pagination(): void
    {
        $this->processPagination();
    }
}
