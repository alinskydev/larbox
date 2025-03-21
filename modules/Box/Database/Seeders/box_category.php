<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('box_category')->insert([
            [
                'lft' => 1,
                'rgt' => 16,
                'parent_id' => null,
                'name' => SeederHelper::localized('Root', false),
                'slug' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 2,
                'rgt' => 13,
                'parent_id' => 1,
                'name' => SeederHelper::localized('Category 1'),
                'slug' => SeederHelper::slug('Category 1'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 3,
                'rgt' => 8,
                'parent_id' => 2,
                'name' => SeederHelper::localized('Category 1-1'),
                'slug' => SeederHelper::slug('Category 1-1'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 4,
                'rgt' => 5,
                'parent_id' => 3,
                'name' => SeederHelper::localized('Category 1-1-1'),
                'slug' => SeederHelper::slug('Category 1-1-1'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 6,
                'rgt' => 7,
                'parent_id' => 3,
                'name' => SeederHelper::localized('Category 1-1-2'),
                'slug' => SeederHelper::slug('Category 1-1-2'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 9,
                'rgt' => 12,
                'parent_id' => 2,
                'name' => SeederHelper::localized('Category 1-2'),
                'slug' => SeederHelper::slug('Category 1-2'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 10,
                'rgt' => 11,
                'parent_id' => 6,
                'name' => SeederHelper::localized('Category 1-2-1'),
                'slug' => SeederHelper::slug('Category 1-2-1'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 14,
                'rgt' => 15,
                'parent_id' => 1,
                'name' => SeederHelper::localized('Category 2'),
                'slug' => SeederHelper::slug('Category 2'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
