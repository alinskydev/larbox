<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('report_product')->insert([
            [
                'report_id' => 1,
                'product_id' => 1,
                'variation_id' => null,
                'supplier_id' => 1,
                'quantity' => 2,
                'sort_index' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'report_id' => 1,
                'product_id' => 1,
                'variation_id' => 1,
                'supplier_id' => 1,
                'quantity' => 5,
                'sort_index' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
