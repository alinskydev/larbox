<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $base_path = base_path();

        $files = glob("$base_path/Modules/*/Database/Seeders/*.php");

        usort($files, fn ($a, $b) => strcmp(basename($a), basename($b)));

        foreach ($files as $file) {
            $class = require($file);
            $class->run();
        }
    }
}
