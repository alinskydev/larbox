<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box_variation')->insert([
            [
                'box_id' => 1,
                'name' => json_encode([
                    'ru' => 'Variation 1 ru',
                    'uz' => 'Variation 1 uz',
                    'en' => 'Variation 1 en',
                ]),
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'image' => '/test_data/images/2.png',
                'images_list' => json_encode([
                    '/test_data/images/1.png',
                    '/test_data/images/2.png',
                    '/test_data/images/3.png',
                ]),
                'sort_index' => 0,
            ],
            [
                'box_id' => 1,
                'name' => json_encode([
                    'ru' => 'Variation 2 ru',
                    'uz' => 'Variation 2 uz',
                    'en' => 'Variation 2 en',
                ]),
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'image' => '/test_data/images/3.png',
                'images_list' => json_encode([
                    '/test_data/images/1.png',
                ]),
                'sort_index' => 1,
            ],
        ]);
    }
};
