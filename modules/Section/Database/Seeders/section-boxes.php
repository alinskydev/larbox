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
                'name' => SectionEnum::BOXES->value,
                'blocks' => json_encode([]),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
