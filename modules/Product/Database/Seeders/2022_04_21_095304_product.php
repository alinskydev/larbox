<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('product')->insert([
            [
                'creator_id' => 2,
                'category_id' => 1,
                'brand_id' => 1,
                'model_number' => 'Model 1',
                'sku' => 'SKU 1',
                'date_eol' => date('Y-m-d'),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 2,
                'category_id' => 1,
                'brand_id' => 1,
                'model_number' => 'Model 2',
                'sku' => 'SKU 2',
                'date_eol' => date('Y-m-d'),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
