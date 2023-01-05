<?php

namespace Modules\User\Helpers;

use Illuminate\Support\Facades\DB;
use Modules\User\Enums\NotificationTypeEnum;

class NotificationHelper
{
    public static function insertMultiple(
        array $ownerIds,
        NotificationTypeEnum $type,
        array $params = [],
        ?int $creatorId = null,
    ): void {
        $createdAt = date('Y-m-d H:i:s');

        $notifications = array_map(fn ($id) => [
            'creator_id' => $creatorId,
            'owner_id' => $id,
            'type' => $type->value,
            'params' => json_encode($params),
            'created_at' => $createdAt,
        ], $ownerIds);

        if ($notifications) {
            DB::table('user_notification')->insert($notifications);
        }
    }
}
