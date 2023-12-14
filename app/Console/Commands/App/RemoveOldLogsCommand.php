<?php

namespace App\Console\Commands\App;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveOldLogsCommand extends Command
{
    protected $signature = 'app:remove_old_logs';

    protected $description = 'Remove old logs';

    public function handle(): void
    {
        DB::table('system_log')
            ->where('created_at', '<', date('Y-m-d 00:00:00', strtotime('-2 days')))
            ->delete();
    }
}
