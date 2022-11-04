<?php

namespace Http\Admin\User\Tests\Notification;

use App\Tests\Feature\Traits\IndexFeatureTestTrait;
use Modules\User\Search\NotificationSearch;

class IndexTest extends _TestCase
{
    use IndexFeatureTestTrait;

    public string $searchClass = NotificationSearch::class;

    public function test_available_filters()
    {
        $this->processAvailableFilters([
            'id' => 1,
            'type' => 'message',
            'is_seen' => 0,
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
