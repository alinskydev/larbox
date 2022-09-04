<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@local.host',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'registered_1',
                'email' => 'registered_1@local.host',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('user1234'),
                'role' => 'registered',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
