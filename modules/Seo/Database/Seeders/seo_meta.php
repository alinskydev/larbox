<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;
use Modules\Section\Models\Section;

return new class extends Seeder
{
    public function run()
    {
        DB::table('seo_meta')->insert([
            [
                'seo_metable_type' => Section::class,
                'seo_metable_id' => 2,
                'value' => SeederHelper::localized('<meta name="description" content="Meta description" />', false),
                'value_as_array' => json_encode([
                    'name' => 'description',
                    'content' => 'Meta description',
                ]),
            ],
        ]);
    }
};
