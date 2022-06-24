<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box_tag_ref')->insert([
            [
                'box_id' => 1,
                'tag_id' => 1,
            ],
            [
                'box_id' => 1,
                'tag_id' => 2,
            ],
        ]);
    }
};
