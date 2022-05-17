<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@local.host',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('vu8eaajiaw'),
                'full_name' => 'Administrator',
                'phone' => 'Phone 1',
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'agent_1',
                'email' => 'agent_1@local.host',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('vu8eaajiaw'),
                'full_name' => 'Agent 1',
                'phone' => null,
                'role' => 'agent',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
