<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('section')->insert([
            [
                'name' => 'boxes',
                'blocks' => json_encode([]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
