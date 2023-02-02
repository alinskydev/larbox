<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;
use Illuminate\Support\Arr;

return new class extends Seeder
{
    public function run()
    {
        $languages = config('larbox.languages');

        $data = Arr::map($languages, function ($value, $key) use ($languages) {
            return [
                'name' => $value,
                'code' => $key,
                'image' => "/test_data/flags/$key.png",
                'is_main' => $key === array_key_first($languages),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        });

        DB::table('system_language')->insert($data);
    }
};
