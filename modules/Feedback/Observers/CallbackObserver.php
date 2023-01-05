<?php

namespace Modules\Feedback\Observers;

use Modules\Feedback\Models\Callback;
use Modules\User\Helpers\NotificationHelper;
use Modules\User\Enums\NotificationTypeEnum;
use Modules\User\Models\User;

class CallbackObserver
{
    public function created(Callback $model): void
    {
        $userIds = User::query()->where('role_id', 1)->getQuery()->get()->pluck('id')->toArray();

        NotificationHelper::insertMultiple(
            ownerIds: $userIds,
            type: NotificationTypeEnum::FEEDBACK_CALLBACK_CREATED,
            params: [
                'id' => $model->id,
            ],
        );
    }
}
