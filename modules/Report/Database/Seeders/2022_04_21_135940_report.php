<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('report')->insert([
            [
                'creator_id' => 2,
                'shop_id' => 1,
                'type' => 'ds',
                'number' => 'Number 1',
                'date_period_type' => 'week',
                'date_period_from' => date('Y-m-d', strtotime('-2 week')),
                'date_period_to' => date('Y-m-d', strtotime('-1 week')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 2,
                'shop_id' => 1,
                'type' => 'ds',
                'number' => 'Number 2',
                'date_period_type' => 'month',
                'date_period_from' => date('Y-m-d', strtotime('-1 month')),
                'date_period_to' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
