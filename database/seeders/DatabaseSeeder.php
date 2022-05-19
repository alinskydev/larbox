<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $files = glob(base_path('Modules/*/Database/Seeders/*.php'));

        $dbCommands = [
            'mysql' => [
                'before' => 'SET FOREIGN_KEY_CHECKS = 0',
                'after' => 'SET FOREIGN_KEY_CHECKS = 1',
            ],
            'pgsql' => [
                'before' => 'SET session_replication_role = "replica"',
                'after' => 'SET session_replication_role = "origin"',
            ],
        ];

        $dbDriver = config('database.default');
        $dbExec = $dbCommands[$dbDriver] ?? ['before' => 'END', 'after' => 'END'];

        DB::statement($dbExec['before']);

        usort($files, fn ($a, $b) => strcmp(basename($a), basename($b)));

        foreach ($files as $file) {
            $class = require($file);
            $class->run();
        }

        DB::statement($dbExec['after']);
    }
}
