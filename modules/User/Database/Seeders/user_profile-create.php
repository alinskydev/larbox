<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_profile')->insert([
            [
                'user_id' => 1,
                'full_name' => 'Administrator',
                'phone' => '+998000000001',
                'image' => '/test_data/images/3.png',
            ],
            [
                'user_id' => 2,
                'full_name' => 'Moderator 1',
                'phone' => null,
                'image' => null,
            ],
            [
                'user_id' => 3,
                'full_name' => 'Registered 1',
                'phone' => null,
                'image' => null,
            ],
        ]);
    }
};
