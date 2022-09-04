<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public array $data;

    public function __construct()
    {
        $this->data = [
            [
                'name' => 'Русский',
                'code' => 'ru',
                'image' => '/test_data/flags/ru.png',
                'is_main' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'O\'zbek',
                'code' => 'uz',
                'image' => '/test_data/flags/uz.png',
                'is_main' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'English',
                'code' => 'en',
                'image' => '/test_data/flags/gb.png',
                'is_main' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    public function run()
    {
        DB::table('system_language')->insert($this->data);
    }
};
