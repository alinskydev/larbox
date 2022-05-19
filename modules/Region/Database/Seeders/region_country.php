<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('region_country')->insert([
            [
                'name' => json_encode([
                    'ru' => 'Country 1 ru',
                    'uz' => 'Country 1 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => json_encode([
                    'ru' => 'Country 2 ru',
                    'uz' => 'Country 2 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
