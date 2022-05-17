<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('task_report')->insert([
            [
                'task_id' => 1,
                'shop_id' => 1,
                'type' => 'ds',
                'date_period_type' => 'week',
                'sort_index' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'task_id' => 1,
                'shop_id' => 1,
                'type' => 'sr',
                'date_period_type' => 'week',
                'sort_index' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'task_id' => 1,
                'shop_id' => 1,
                'type' => 'ds',
                'date_period_type' => 'month',
                'sort_index' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
