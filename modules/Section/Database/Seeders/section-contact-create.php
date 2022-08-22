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
                'name' => 'contact',
                'blocks' => json_encode([
                    'socials_facebook' => '',
                    'socials_instagram' => '',
                    'socials_youtube' => '',

                    'branches' => DataHelper::multiply(
                        range(1, 2),
                        fn ($index) => [
                            'name' => "Name $index",
                            'phones' => [
                                "+998 00 000 00 {$index}1",
                                "+998 00 000 00 {$index}2",
                            ],
                            'description' => json_decode(DataHelper::localized("Description $index")),
                        ],
                    ),
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
