<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box_variation')->insert([
            [
                'box_id' => 1,
                'name' => DataHelper::localized('Variation 1'),
                'sort_index' => 0,
            ],
            [
                'box_id' => 1,
                'name' => DataHelper::localized('Variation 1'),
                'sort_index' => 1,
            ],
        ]);
    }
};
