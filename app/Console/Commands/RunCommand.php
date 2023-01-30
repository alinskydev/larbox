<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunCommand extends Command
{
    protected $signature = 'larbox:run';

    protected $description = 'Run any script';

    public function handle(): void
    {
    }
}
