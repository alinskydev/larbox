<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('system_settings')->insert([
            [
                'name' => 'admin_email',
                'value' => 'info@local.host',
            ],
            [
                'name' => 'delete_old_files',
                'value' => 0,
            ],
            [
                'name' => 'favicon',
                'value' => '/test_data/logo.png',
            ],
            [
                'name' => 'logo',
                'value' => '/test_data/logo.png',
            ],
            [
                'name' => 'project_name',
                'value' => 'Larbox',
            ],
        ]);
    }
};
