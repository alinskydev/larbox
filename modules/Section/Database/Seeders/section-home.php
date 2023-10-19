<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;
use Modules\Section\Enums\SectionEnum;

return new class extends Seeder
{
    public function run()
    {
        DB::table('section')->insert([
            [
                'name' => SectionEnum::HOME->value,
                'blocks' => json_encode([
                    'first_text_1' => 'Text 1',
                    'first_text_1_localized' => json_decode(SeederHelper::localized('Text 1')),
                    'first_text_2' => 'Text 2',
                    'first_text_2_localized' => json_decode(SeederHelper::localized('Text 2')),
                    'first_text_3' => 'Text 3',
                    'first_text_3_localized' => json_decode(SeederHelper::localized('Text 3')),

                    'second_image_desktop' => 'test_data/images/1.png',
                    'second_image_tablet' => 'test_data/images/2.png',
                    'second_image_mobile' => 'test_data/images/3.png',
                    'second_images_list' => [
                        'test_data/images/1.png',
                        'test_data/images/2.png',
                        'test_data/images/3.png',
                    ],

                    'relations_1' => array_map(
                        fn ($index) => [
                            'text' => "Text $index",
                            'image' => "/test_data/images/$index.png",
                        ],
                        range(1, 2),
                    ),

                    'relations_2' => array_map(
                        fn ($index) => [
                            'text_localized' => json_decode(SeederHelper::localized("Text $index")),
                            'images_list' => [
                                'test_data/images/1.png',
                                'test_data/images/2.png',
                                'test_data/images/3.png',
                            ],
                        ],
                        range(1, 2),
                    ),
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
