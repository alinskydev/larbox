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

        $files = glob(base_path('modules/*/Database/Seeders/*.php'));
        usort($files, fn ($a, $b) => strcmp(basename($a), basename($b)));

        DB::statement($dbExec['before']);

        foreach ($files as $file) {
            $class = require($file);
            $class->run();
        }

        DB::statement($dbExec['after']);
    }
}
