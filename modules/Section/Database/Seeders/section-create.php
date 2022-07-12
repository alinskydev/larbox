<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('section')->insert([
            [
                'name' => 'layout',
                'blocks' => json_encode([
                    'header_phone' => '+998 (00) 111 11 11',
                    'footer_phone' => '+998 (00) 222 22 22',
                    'footer_description' => [
                        'ru' => 'Description ru',
                        'uz' => 'Description uz',
                        'en' => 'Description en',
                    ],
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
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
                'blocks' => json_encode([
                    'social_facebook' => '',
                    'social_instagram' => '',
                    'social_youtube' => '',
                    'branches' => [],
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'boxes',
                'blocks' => json_encode([]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
