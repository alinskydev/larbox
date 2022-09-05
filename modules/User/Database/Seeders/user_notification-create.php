<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\DataHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_notification')->insert([
            [
                'creator_id' => 1,
                'owner_id' => 1,
                'type' => 'message',
                'params' => json_encode([
                    'message' => 'Message 1',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 1,
                'owner_id' => 1,
                'type' => 'message',
                'params' => json_encode([
                    'message' => 'Message 2',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 1,
                'owner_id' => 3,
                'type' => 'message',
                'params' => json_encode([
                    'message' => 'Message 3',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
