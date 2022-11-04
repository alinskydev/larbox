<?php

namespace Http\Admin\User\Tests\Role;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\User\Search\RoleSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = RoleSearch::class;

    public function test_available_filters()
    {
        $this->processAvailableFilters([
            'id' => 1,
            'name' => 'admin',
        ]);
    }

    public function test_available_sortings()
    {
        $this->processAvailableSortings();
    }

    public function test_pagination()
    {
        $this->processPagination();
    }
}
