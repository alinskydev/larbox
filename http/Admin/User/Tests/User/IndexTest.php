<?php

namespace Http\Admin\User\Tests\User;

use App\Testing\Feature\Traits\IndexFeatureTestTrait;
use Modules\User\Search\UserSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = UserSearch::class;

    public function test_available_filters(): void
    {
        $this->processAvailableFilters([
            'common' => 'admin',
            'id' => 1,
            'role_id' => 1,
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
