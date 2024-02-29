<?php

namespace App\Console\Commands\Larbox;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class PullCommand extends Command
{
    protected $signature = 'larbox:pull';

    protected $description = 'Trigger for pull request';

    public function handle(): void
    {
        Artisan::call('queue:restart');

        Cache::forget('app_language');
        Cache::forget('app_settings');
    }
}
