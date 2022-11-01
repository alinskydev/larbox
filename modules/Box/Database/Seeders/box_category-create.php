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
                'depth' => 0,
                'name' => SeederHelper::localized('Root', false),
                'slug' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 2,
                'rgt' => 13,
                'depth' => 1,
                'name' => SeederHelper::localized('Category 1'),
                'slug' => 'category-1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 3,
                'rgt' => 8,
                'depth' => 2,
                'name' => SeederHelper::localized('Category 1-1'),
                'slug' => 'category-1-1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 4,
                'rgt' => 5,
                'depth' => 3,
                'name' => SeederHelper::localized('Leaf 1'),
                'slug' => 'leaf-1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 6,
                'rgt' => 7,
                'depth' => 3,
                'name' => SeederHelper::localized('Leaf 2'),
                'slug' => 'leaf-2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 9,
                'rgt' => 12,
                'depth' => 2,
                'name' => SeederHelper::localized('Category 1-2'),
                'slug' => 'category-1-2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 10,
                'rgt' => 11,
                'depth' => 3,
                'name' => SeederHelper::localized('Leaf 1'),
                'slug' => 'leaf-1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lft' => 14,
                'rgt' => 15,
                'depth' => 1,
                'name' => SeederHelper::localized('Category 2'),
                'slug' => 'category-2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
