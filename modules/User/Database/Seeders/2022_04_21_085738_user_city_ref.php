<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_city_ref')->insert([
            [
                'user_id' => 2,
                'city_id' => 1,
            ],
        ]);
    }
};
