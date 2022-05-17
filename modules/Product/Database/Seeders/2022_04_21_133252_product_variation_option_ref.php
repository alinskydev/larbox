<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('product_variation_option_ref')->insert([
            [
                'variation_id' => 1,
                'option_id' => 1,
            ],
        ]);
    }
};
