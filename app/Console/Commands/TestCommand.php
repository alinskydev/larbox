<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class TestCommand extends Command
{
    protected $signature = 'larbox:test';

    protected $description = 'Migrate and test';

    public function handle(): void
    {
        $stream = fopen('php://output', 'w');

        Artisan::call('larbox:migrate', [], new StreamOutput($stream));
        Artisan::call("test", [], new StreamOutput($stream));
    }
}
