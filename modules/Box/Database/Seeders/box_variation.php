<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box_variation')->insert([
            [
                'box_id' => 1,
                'name' => SeederHelper::localized('Variation 1'),
                'image' => '/test_data/images/1.png',
                'sort_index' => 0,
            ],
            [
                'box_id' => 1,
                'name' => SeederHelper::localized('Variation 2'),
                'image' => '/test_data/images/2.png',
                'sort_index' => 1,
            ],
        ]);
    }
};
