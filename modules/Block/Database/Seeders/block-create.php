<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Modules\Block\Models\Block;

use App\Casts\Storage\AsFile;
use App\Casts\Storage\AsFiles;
use App\Casts\Storage\AsImage;
use App\Casts\Storage\AsImages;

return new class extends Seeder
{
    public function run()
    {
        DB::table('block')->insert([
            [
                'page_id' => 1,
                'name' => 'welcome_title',
                'options' => json_encode([]),
                'value' => json_encode([]),
            ],
            [
                'page_id' => 1,
                'name' => 'welcome_description',
                'options' => json_encode([]),
                'value' => json_encode([]),
            ],
            [
                'page_id' => 1,
                'name' => 'welcome_image',
                'options' => json_encode([
                    'cast' => AsImage::class . ':100|500',
                ]),
                'value' => json_encode(
                    '/test_data/images/1.png',
                ),
            ],
            [
                'page_id' => 1,
                'name' => 'slider_1',
                'options' => json_encode([]),
                'value' => json_encode([]),
            ],
            [
                'page_id' => 1,
                'name' => 'about_title',
                'options' => json_encode([]),
                'value' => json_encode([]),
            ],
            [
                'page_id' => 1,
                'name' => 'about_slogan',
                'options' => json_encode([]),
                'value' => json_encode([]),
            ],
            [
                'page_id' => 1,
                'name' => 'about_description',
                'options' => json_encode([]),
                'value' => json_encode([]),
            ],
            [
                'page_id' => 1,
                'name' => 'partners',
                'options' => json_encode([]),
                'value' => json_encode([]),
            ],
            [
                'page_id' => 1,
                'name' => 'slider_2',
                'options' => json_encode([]),
                'value' => json_encode([]),
            ],
        ]);
    }
};
