<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Testing\Feature\Traits\IndexFeatureTestTrait;
use Modules\Box\Search\TagSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = TagSearch::class;

    public function test_available_filters(): void
    {
        $this->processAvailableFilters([
            'id' => 1,
            'name' => 'tag',
        ]);
    }

    public function test_available_sortings(): void
    {
        $this->processAvailableSortings();
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
