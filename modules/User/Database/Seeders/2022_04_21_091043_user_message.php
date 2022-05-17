<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_message')->insert([
            [
                'user_id' => 2,
                'text' => 'Text 1',
                'is_sent_by_admin' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2,
                'text' => 'Text 2',
                'is_sent_by_admin' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
