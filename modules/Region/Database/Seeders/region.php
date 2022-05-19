<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('region')->insert([
            [
                'name' => json_encode([
                    'ru' => 'Region 1 ru',
                    'uz' => 'Region 1 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => json_encode([
                    'ru' => 'Region 2 ru',
                    'uz' => 'Region 2 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};

