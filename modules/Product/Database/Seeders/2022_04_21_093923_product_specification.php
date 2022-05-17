<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('product_specification')->insert([
            [
                'name' => json_encode([
                    'ru' => 'Color ru',
                    'uz' => 'Color uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => json_encode([
                    'ru' => 'Specification 2 ru',
                    'uz' => 'Specification 2 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
