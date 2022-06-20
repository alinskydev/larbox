<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
