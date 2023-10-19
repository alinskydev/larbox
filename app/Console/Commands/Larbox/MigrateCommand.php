<?php

namespace App\Console\Commands\Larbox;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Output\StreamOutput;

class MigrateCommand extends Command
{
    protected $signature = 'larbox:migrate';

    protected $description = 'Migrate base';

    public function handle(): void
    {
        $stream = fopen('php://output', 'w');

        // Migrating structure

        app()->register(DBStructureServiceProvider::class);
        Artisan::call('migrate:fresh', [], new StreamOutput($stream));

        // Seeding

        $files = glob(base_path('modules/*/Database/Seeders/*.php'));
        foreach ($files as $file) (require($file))->run();

        // Setting foreign keys

        app()->register(DBRelationsServiceProvider::class);
        Artisan::call('migrate', [], new StreamOutput($stream));

        $this->extraSeeders();
    }

    private function extraSeeders()
    {
    }
}

class DBStructureServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $files = glob(base_path('modules/*/Database/Migrations/*.php'));
        $this->loadMigrationsFrom($files);
    }
}

class DBRelationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $files = glob(base_path('modules/*/Database/*.php'));
        $this->loadMigrationsFrom($files);
    }
}
