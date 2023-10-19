<?php

namespace App\Console\Commands\Larbox;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class TestCommand extends Command
{
    protected $signature = 'larbox:test';

    protected $description = 'Testing';

    public function handle(): void
    {
        $stream = fopen('php://output', 'w');

        Artisan::call('larbox:migrate');
        Artisan::call('test', [], new StreamOutput($stream));
    }
}
