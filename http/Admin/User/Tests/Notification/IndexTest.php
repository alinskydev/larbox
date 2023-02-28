<?php

namespace Http\Admin\User\Tests\Notification;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\User\Enums\NotificationTypeEnum;
use Modules\User\Search\NotificationSearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait {
        test_available_relations as private;
        test_show_with_deleted as private;
        test_show_only_deleted as private;
    }

    public string $searchClass = NotificationSearch::class;

    public function test_available_filters(): void
    {
        $this->sendRequestWithFilters([
            'id' => 1,
            'type' => NotificationTypeEnum::MESSAGE->value,
            'is_seen' => 0,
        ]);
    }
}
