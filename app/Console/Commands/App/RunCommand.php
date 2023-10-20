<?php

namespace App\Console\Commands\App;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class RunCommand extends Command
{
    protected $signature = 'app:run';

    protected $description = 'Run any script';

    public function handle(): void
    {
        dd(Str::is('qwe.qwe', 'qwe.*'));
    }
}
