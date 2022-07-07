<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box')->insert([
            [
                'brand_id' => 1,
                'name' => json_encode([
                    'ru' => 'Box 1 ru',
                    'uz' => 'Box 1 uz',
                    'en' => 'Box 1 en',
                ]),
                'slug' => 'box-1',
                'description' => '[]',
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'image' => '/test_data/images/2.png',
                'images_list' => json_encode([
                    '/test_data/images/1.png',
                    '/test_data/images/2.png',
                    '/test_data/images/3.png',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'brand_id' => 1,
                'name' => json_encode([
                    'ru' => 'Box 2 ru',
                    'uz' => 'Box 2 uz',
                    'en' => 'Box 2 en',
                ]),
                'slug' => 'box-2',
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'image' => '/test_data/images/3.png',
                'images_list' => json_encode([
                    '/test_data/images/1.png',
                ]),
                'description' => '[]',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
