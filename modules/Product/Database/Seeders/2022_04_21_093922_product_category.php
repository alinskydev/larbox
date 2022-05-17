<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('product_category')->insert([
            [
                'name' => json_encode([
                    'ru' => 'Category 1 ru',
                    'uz' => 'Category 1 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => json_encode([
                    'ru' => 'Category 2 ru',
                    'uz' => 'Category 2 uz',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
