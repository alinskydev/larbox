<?php

namespace App\Loggers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class DatabaseLogger
{
    public function __invoke(array $config): Logger
    {
        return new Logger('database', [
            new DatabaseLoggerHandler(),
        ]);
    }
}

class DatabaseLoggerHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        try {
            $level = $record->level;

            /** @var \Throwable $exception */
            $exception = $record->context['exception'];

            DB::table('system_log')->insert([
                'level' => $level->name,
                'file' => str_replace(base_path(), '', $exception->getFile()),
                'line' => $exception->getLine(),
                'class_name' => $exception::class,
                'message' => $exception->getMessage(),
                'trace' => json_encode($exception->getTrace()),
                'user_id' => request()->user()?->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            Log::channel('daily')->error($e->getMessage(), ['exception' => $e]);
        }
    }
}
