<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('product_category_specification_ref')->insert([
            [
                'category_id' => 1,
                'specification_id' => 1,
            ],
            [
                'category_id' => 1,
                'specification_id' => 2,
            ],
        ]);
    }
};
