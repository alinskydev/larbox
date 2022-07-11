<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('page')->insert([
            [
                'name' => 'home',
                'blocks' => json_encode([
                    'welcome_title' => [
                        'ru' => 'Title ru',
                        'uz' => 'Title uz',
                        'en' => 'Title en',
                    ],
                    'welcome_slogan' => 'Slogan',
                    'welcome_description' => [
                        'ru' => 'Description ru',
                        'uz' => 'Description uz',
                        'en' => 'Description en',
                    ],
                    'welcome_image' => '/test_data/images/1.png',
                    'images_list' => [
                        '/test_data/images/1.png',
                        '/test_data/images/2.png',
                        '/test_data/images/3.png',
                    ],
                    'slider' => [],
                    'portfolio' => [],
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'contact',
                'blocks' => json_encode([]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
