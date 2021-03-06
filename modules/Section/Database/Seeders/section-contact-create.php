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
                    'social_facebook' => '',
                    'social_instagram' => '',
                    'social_youtube' => '',
                    'branches' => DataHelper::multiply(
                        range(1, 2),
                        function ($index) {
                            return [
                                'name' => "Name $index",
                                'phone' => "Phone $index",
                                'description' => json_decode(DataHelper::localized("Description $index")),
                            ];
                        }
                    ),
                ]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
