<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box_category_ref')->insert([
            [
                'box_id' => 1,
                'category_id' => 6,
            ],
            [
                'box_id' => 1,
                'category_id' => 7,
            ],
            [
                'box_id' => 2,
                'category_id' => 8,
            ],
        ]);
    }
};
