<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('shop')->insert([
            [
                'agent_id' => 2,
                'city_id' => 1,
                'company_id' => 1,
                'name' => 'Shop 1',
                'address' => 'Address 1',
                'has_credit_line' => 1,
                'location' => json_encode([
                    '41.385809',
                    '-5.493923',
                ]),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'agent_id' => 2,
                'city_id' => 1,
                'company_id' => 1,
                'name' => 'Shop 2',
                'address' => 'Address 2',
                'has_credit_line' => 0,
                'location' => json_encode([
                    '37.166028',
                    '86.101243',
                ]),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
