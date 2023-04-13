<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box')->insert([
            [
                'brand_id' => 1,
                'name' => SeederHelper::localized('Box 1'),
                'slug' => SeederHelper::slug('Box 1'),
                'description' => SeederHelper::localized('Description 1'),
                'price' => 2000,
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:00'),
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
                'name' => SeederHelper::localized('Box 2'),
                'slug' => SeederHelper::slug('Box 2'),
                'description' => SeederHelper::localized(null, false),
                'price' => 5500,
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:00'),
                'image' => null,
                'images_list' => json_encode([
                    '/test_data/images/1.png',
                    '/test_data/logo.png',
                    '/test_data/media/svg_image.svg',
                ]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        // for ($a = 1; $a <= 10; $a++) {
        //     $date = date('Y-m-d');
        //     $datetime = date('Y-m-d H:i:00');

        //     $data = [];

        //     for ($i = 1; $i <= 1000; $i++) {
        //         $index = $a * 1000 + $i;

        //         $data[] = [
        //             'brand_id' => 1,
        //             'name' => SeederHelper::localized("Box $index"),
        //             'slug' => SeederHelper::slug("Box $index"),
        //             'description' => SeederHelper::localized("Description $index"),
        //             'price' => $index * 2,
        //             'date' => $date,
        //             'datetime' => $datetime,
        //             'image' => '/test_data/images/2.png',
        //             'images_list' => json_encode([
        //                 '/test_data/images/1.png',
        //                 '/test_data/images/2.png',
        //                 '/test_data/images/3.png',
        //             ]),
        //             'created_at' => $datetime,
        //             'updated_at' => $datetime,
        //         ];
        //     }

        //     DB::table('box')->insert($data);
        // }
    }
};
