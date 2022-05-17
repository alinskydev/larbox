<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('shop_brand_ref')->insert([
            [
                'shop_id' => 1,
                'brand_id' => 1,
            ],
            [
                'shop_id' => 1,
                'brand_id' => 2,
            ],
        ]);
    }
};
