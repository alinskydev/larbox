<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('block_page')->insert([
            [
                'name' => 'home',
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'contact',
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
