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
                    'first_text_1' => 'Text 1',
                    'first_text_1_localized' => json_decode(DataHelper::localized('Text 1')),
                    'first_text_2' => 'Text 2',
                    'first_text_2_localized' => json_decode(DataHelper::localized('Text 2')),
                    'first_text_3' => 'Text 3',
                    'first_text_3_localized' => json_decode(DataHelper::localized('Text 3')),

                    'second_image' => '/test_data/images/1.png',
                    'second_images_list' => [
                        '/test_data/images/1.png',
                        '/test_data/images/2.png',
                        '/test_data/images/3.png',
                    ],
                    'second_image_desktop' => json_decode(DataHelper::localized('/test_data/images/1.png', false)),
                    'second_image_tablet' => json_decode(DataHelper::localized('/test_data/images/2.png', false)),
                    'second_image_mobile' => json_decode(DataHelper::localized('/test_data/images/3.png', false)),

                    'relations_1' => DataHelper::multiply(
                        range(1, 2),
                        fn ($index) => [
                            'text' => "Text $index",
                            'image' => "/test_data/images/$index.png",
                            'images_list' => [
                                '/test_data/images/1.png',
                                '/test_data/images/2.png',
                                '/test_data/images/3.png',
                            ],
                        ],
                    ),

                    'relations_2' => DataHelper::multiply(
                        range(1, 2),
                        fn ($index) => [
                            'text_localized' => json_decode(DataHelper::localized("Text $index")),
                            'image_desktop' => json_decode(DataHelper::localized('/test_data/images/1.png', false)),
                            'image_tablet' => json_decode(DataHelper::localized('/test_data/images/2.png', false)),
                            'image_mobile' => json_decode(DataHelper::localized('/test_data/images/3.png', false)),
                        ],
                    ),
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
