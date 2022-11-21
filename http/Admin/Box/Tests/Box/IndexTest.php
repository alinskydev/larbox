<?php

namespace Http\Admin\Box\Tests\Box;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\Box\Search\BoxSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = BoxSearch::class;

    public function test_available_relations()
    {
        $this->processAvailableRelations();
    }

    public function test_available_filters()
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

    public function test_available_sortings()
    {
        $this->processAvailableSortings();
    }

    public function test_show_with_deleted()
    {
        $this->processShowWithDeleted();
    }

    public function test_show_only_deleted()
    {
        $this->processShowOnlyDeleted();
    }

    public function test_pagination()
    {
        $this->processPagination();
    }
}
