<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_role')->insert([
            [
                'name' => SeederHelper::localized('Admin'),
                'permissions' => json_encode([
                    '*',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => SeederHelper::localized('Moderator'),
                'permissions' => json_encode([
                    'box.*',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
