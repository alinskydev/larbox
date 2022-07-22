<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('seo_meta')->insert([
            [
                'seo_metable_type' => 'Modules\Box\Models\Box',
                'seo_metable_id' => 1,
                'head' => DataHelper::localized('Meta'),
            ],
            [
                'seo_metable_type' => 'Modules\Box\Models\Brand',
                'seo_metable_id' => 1,
                'head' => DataHelper::localized('Meta'),
            ],
            [
                'seo_metable_type' => 'Modules\Section\Models\Section',
                'seo_metable_id' => 2,
                'head' => DataHelper::localized('Meta'),
            ],
        ]);
    }
};
