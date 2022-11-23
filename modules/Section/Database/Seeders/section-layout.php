<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;

return new class extends Seeder
{
    public function run()
    {
        DB::table('section')->insert([
            [
                'name' => 'layout',
                'blocks' => json_encode([
                    'header_phone' => '+998 00 000 00 01',

                    'footer_phone' => '+998 00 000 00 02',
                    'footer_copyright' => json_decode(SeederHelper::localized('Copyright')),
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
