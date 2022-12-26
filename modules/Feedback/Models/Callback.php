<?php

namespace Modules\Feedback\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\User\Helpers\NotificationHelper;
use Modules\User\Models\Notification;
use Modules\User\Models\User;

class Callback extends Model
{
    use SoftDeletes;

    protected $table = 'feedback_callback';

    protected static function boot(): void
    {
        parent::boot();

        static::created(function (self $model) {

            // Creating notifications for all admins

            $userIds = User::query()->where('role_id', 1)->getQuery()->get()->pluck('id')->toArray();

            NotificationHelper::insertMultiple(
                ownerIds: $userIds,
                type: Notification::TYPE_FEEDBACK_CALLBACK_CREATED,
                params: [
                    'id' => $model->id,
                ],
            );
        });
    }
}
