<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_profile')->insert([
            [
                'user_id' => 1,
                'full_name' => 'Administrator',
                'phone' => '+998001234567',
                'image' => '/test_data/images/3.png',
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
