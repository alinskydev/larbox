<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('product_specification_option')->insert([
            [
                'specification_id' => 1,
                'name' => json_encode([
                    'ru' => 'White ru',
                    'uz' => 'White uz',
                ]),
                'sort_index' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'specification_id' => 1,
                'name' => json_encode([
                    'ru' => 'Black ru',
                    'uz' => 'Black uz',
                ]),
                'sort_index' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'specification_id' => 1,
                'name' => json_encode([
                    'ru' => 'Red ru',
                    'uz' => 'Red uz',
                ]),
                'sort_index' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
