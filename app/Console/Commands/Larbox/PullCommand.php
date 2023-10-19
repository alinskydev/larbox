<?php

namespace App\Console\Commands\Larbox;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PullCommand extends Command
{
    protected $signature = 'larbox:pull';

    protected $description = 'Trigger for pull request';

    public function handle(): void
    {
        Artisan::call('migrate');
        Artisan::call('queue:restart');
    }
}
