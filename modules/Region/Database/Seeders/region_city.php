<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('region_city')->insert([
            [
                'region_id' => 1,
                'name' => json_encode([
                    'ru' => 'City 1 ru',
                    'uz' => 'City 1 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'region_id' => 1,
                'name' => json_encode([
                    'ru' => 'City 2 ru',
                    'uz' => 'City 2 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};

