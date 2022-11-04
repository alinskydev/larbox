<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\Box\Search\TagSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = TagSearch::class;

    public function test_available_filters()
    {
        $this->processAvailableFilters([
            'id' => 1,
            'name' => 'tag',
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
