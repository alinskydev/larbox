<?php

namespace Http\Admin\Feedback\Tests\Callback;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\Feedback\Search\CallbackSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = CallbackSearch::class;

    public function test_available_filters()
    {
        $this->processAvailableFilters([
            'id' => 1,
            'status' => 'unprocessed',
            'common' => 'full name',
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
