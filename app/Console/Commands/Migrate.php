<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Output\StreamOutput;

class Migrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larbox:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate base';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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
    }
}

class DBStructureServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $files = glob(base_path('modules/*/Database/Migrations/*.php'));
        $this->loadMigrationsFrom($files);
    }
}

class DBRelationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $files = glob(base_path('modules/*/Database/*.php'));
        $this->loadMigrationsFrom($files);
    }
}
