<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('seo_meta')->insert([
            [
                'seo_metable_type' => 'Modules\Section\Models\Section',
                'seo_metable_id' => 2,
                'head' => SeederHelper::localized('<meta name="description" content="Meta description" />', false),
            ],
        ]);
    }
};
