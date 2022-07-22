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
                'name' => 'layout',
                'blocks' => json_encode([
                    'header_phone' => '+998 (00) 111 11 11',
                    'footer_phone' => '+998 (00) 222 22 22',
                    'footer_description' => json_decode(DataHelper::localized('Description'), true),
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
