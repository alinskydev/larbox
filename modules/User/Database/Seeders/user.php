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
                'role_id' => 1,
                'username' => 'admin',
                'email' => 'admin@local.host',
                'password' => Hash::make(env('USER_ADMIN_PASSWORD')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => 2,
                'username' => 'moderator_1',
                'email' => 'moderator_1@local.host',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id' => null,
                'username' => 'registered_1',
                'email' => 'registered_1@local.host',
                'password' => Hash::make('user1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
