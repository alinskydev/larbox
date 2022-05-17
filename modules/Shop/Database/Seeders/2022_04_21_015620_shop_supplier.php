<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('shop_supplier')->insert([
            [
                'creator_id' => 2,
                'country_id' => 1,
                'short_name' => 'Short name 1',
                'full_name' => 'Full name 1',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 2,
                'country_id' => 1,
                'short_name' => 'Short name 2',
                'full_name' => 'Full name 2',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
