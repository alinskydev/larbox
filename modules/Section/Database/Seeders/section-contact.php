<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;
use Modules\Section\Enums\SectionEnum;

return new class extends Seeder
{
    public function run()
    {
        DB::table('section')->insert([
            [
                'name' => SectionEnum::CONTACT->value,
                'blocks' => json_encode([
                    'socials_facebook' => '',
                    'socials_instagram' => '',
                    'socials_youtube' => '',

                    'branches' => array_map(
                        fn ($index) => [
                            'name' => "Name $index",
                            'phones' => [
                                "+998 00 000 00 {$index}1",
                                "+998 00 000 00 {$index}2",
                            ],
                            'description' => json_decode(SeederHelper::localized("Description $index")),
                        ],
                        range(1, 2),
                    ),
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
