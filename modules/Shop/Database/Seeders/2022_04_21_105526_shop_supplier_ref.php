<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('shop_supplier_ref')->insert([
            [
                'shop_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'shop_id' => 1,
                'supplier_id' => 2,
            ],
        ]);
    }
};
