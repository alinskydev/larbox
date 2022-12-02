<?php

namespace Http\Admin\User\Tests\Notification;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\User\Search\NotificationSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = NotificationSearch::class;

    public function test_available_filters(): void
    {
        $this->processAvailableFilters([
            'id' => 1,
            'type' => 'message',
            'is_seen' => 0,
        ]);
    }

    public function test_available_sortings(): void
    {
        $this->processAvailableSortings();
    }

    public function test_pagination(): void
    {
        $this->processPagination();
    }
}
