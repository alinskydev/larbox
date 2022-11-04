<?php

namespace Http\Admin\User\Tests\User;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\User\Search\UserSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = UserSearch::class;

    public function test_available_filters()
    {
        $this->processAvailableFilters([
            'common' => 'admin',
            'id' => 1,
            'role_id' => 1,
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
