<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box_brand')->insert([
            [
                'creator_id' => 1,
                'name' => 'Brand 1',
                'slug' => SeederHelper::slug('Brand 1', false),
                'file' => 'test_data/media/webp.webp',
                'files_list' => json_encode([
                    'test_data/media/music.mp3',
                    'test_data/media/video.mp4',
                    'test_data/images/1.png',
                ]),
                'show_on_the_home_page' => 1,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'creator_id' => 3,
                'name' => 'Brand 2',
                'slug' => SeederHelper::slug('Brand 2', false),
                'file' => null,
                'files_list' => json_encode([
                    'test_data/media/svg_html.svg',
                    'test_data/media/svg_image.svg',
                    'test_data/media/svg_text.svg',
                ]),
                'show_on_the_home_page' => 0,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
