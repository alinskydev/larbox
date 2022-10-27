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
                'parent_id' => 0,
                'depth' => 0,
                'position' => 0,
                'name' => SeederHelper::localized('Root', false),
                'slug' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'parent_id' => 1,
                'depth' => 1,
                'position' => 0,
                'name' => SeederHelper::localized('Category 1'),
                'slug' => 'category-1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 1,
                'depth' => 1,
                'position' => 1,
                'name' => SeederHelper::localized('Category 2'),
                'slug' => 'category-2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'parent_id' => 2,
                'depth' => 2,
                'position' => 0,
                'name' => SeederHelper::localized('Category 1-1'),
                'slug' => 'category-1-1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 2,
                'depth' => 2,
                'position' => 1,
                'name' => SeederHelper::localized('Category 1-2'),
                'slug' => 'category-1-2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'parent_id' => 4,
                'depth' => 3,
                'position' => 0,
                'name' => SeederHelper::localized('Leaf 1'),
                'slug' => 'leaf-1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 4,
                'depth' => 3,
                'position' => 1,
                'name' => SeederHelper::localized('Leaf 2'),
                'slug' => 'leaf-2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id' => 5,
                'depth' => 3,
                'position' => 0,
                'name' => SeederHelper::localized('Leaf 1'),
                'slug' => 'leaf-1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
