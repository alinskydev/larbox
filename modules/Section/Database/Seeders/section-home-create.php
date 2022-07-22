<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('section')->insert([
            [
                'name' => 'home',
                'blocks' => json_encode([
                    'welcome_title' => json_decode(DataHelper::localized('Title'), true),
                    'welcome_slogan' => 'Slogan',
                    'welcome_description' => json_decode(DataHelper::localized('Description'), true),
                    'welcome_image' => '/test_data/images/1.png',
                    'images_list' => [
                        '/test_data/images/1.png',
                        '/test_data/images/2.png',
                        '/test_data/images/3.png',
                    ],
                    'slider' => DataHelper::multiply(
                        range(1, 2),
                        function ($index) {
                            return [
                                'title' => json_decode(DataHelper::localized("Title $index")),
                                'subtitle' => json_decode(DataHelper::localized("Subtitle $index")),
                                'image' => "/test_data/images/$index.png",
                            ];
                        }
                    ),
                    'portfolio' => DataHelper::multiply(
                        range(1, 2),
                        function ($index) {
                            return [
                                'name' => "Name $index",
                                'description' => json_decode(DataHelper::localized("Description $index")),
                                'images_list' => [
                                    '/test_data/images/1.png',
                                    '/test_data/images/2.png',
                                    '/test_data/images/3.png',
                                ],
                            ];
                        }
                    ),
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
