<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('shop_contact')->insert([
            [
                'creator_id' => 2,
                'first_name' => 'First name 1',
                'second_name' => 'Second name 1',
                'last_name' => 'Last name 1',
                'position' => 'Position 1',
                'phone' => 'Phone 1',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 2,
                'first_name' => 'First name 2',
                'second_name' => 'Second name 2',
                'last_name' => 'Last name 2',
                'position' => 'Position 2',
                'phone' => 'Phone 2',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
