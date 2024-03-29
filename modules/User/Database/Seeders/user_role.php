<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('user_role')->insert([
            [
                'name' => SeederHelper::localized('Admin', false),
                'routes' => json_encode([
                    'admin.*',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => SeederHelper::localized('Moderator', false),
                'routes' => json_encode([
                    'admin.box.box.*',
                    'admin.box.tag.index',
                    'admin.box.tag.show',
                    'admin.box.tag.create',
                    'admin.box.tag.update',
                    'admin.section.show',
                    'admin.user.role.*',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
