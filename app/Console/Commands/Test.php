<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larbox:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate and test';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $stream = fopen('php://output', 'w');
        Artisan::call('larbox:migrate', [], new StreamOutput($stream));
        Artisan::call("test", [], new StreamOutput($stream));
    }
}
