<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_profile')->insert([
            [
                'user_id' => 1,
                'full_name' => 'Administrator',
                'phone' => 'Phone 1',
                'image' => '/test_data/media/webp.webp',
            ],
            [
                'user_id' => 2,
                'full_name' => 'Registered 1',
                'phone' => null,
                'image' => null,
            ],
        ]);
    }
};
