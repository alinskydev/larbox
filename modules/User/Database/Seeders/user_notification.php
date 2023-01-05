<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;
use Modules\User\Enums\NotificationTypeEnum;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_notification')->insert([
            [
                'creator_id' => 1,
                'owner_id' => 1,
                'type' => NotificationTypeEnum::MESSAGE->value,
                'params' => json_encode([
                    'text' => 'Text 1',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 1,
                'owner_id' => 1,
                'type' => NotificationTypeEnum::MESSAGE->value,
                'params' => json_encode([
                    'text' => 'Text 2',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 1,
                'owner_id' => 2,
                'type' => NotificationTypeEnum::MESSAGE->value,
                'params' => json_encode([
                    'text' => 'Text 3',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
