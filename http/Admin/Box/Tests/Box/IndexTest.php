<?php

namespace Http\Admin\Box\Tests\Box;

use App\Testing\Feature\Traits\IndexFeatureTestTrait;
use Modules\Box\Search\BoxSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = BoxSearch::class;

    public function test_available_relations(): void
    {
        $this->processAvailableRelations();
    }

    public function test_available_filters(): void
    {
        $this->processAvailableFilters([
            'id' => 1,
            'brand_id' => 1,
            'name' => 'box',
            'price' => [
                1000,
                10000,
            ],
            'date' => [
                date(LARBOX_FORMAT_DATE, strtotime('-1 day')),
                date(LARBOX_FORMAT_DATE),
            ],
            'datetime' => date(LARBOX_FORMAT_DATETIME),

            'categories.id' => 3,
            'tags.id' => [1, 2],
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
