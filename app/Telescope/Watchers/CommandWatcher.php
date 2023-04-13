<?php

namespace App\Telescope\Watchers;

use App\Telescope\Helpers\TelescopeHelper;
use Laravel\Telescope\Watchers\CommandWatcher as BaseCommandWatcher;
use Illuminate\Console\Events\CommandFinished;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;

class CommandWatcher extends BaseCommandWatcher
{
    public function recordCommand(CommandFinished $event): void
    {
        if (!Telescope::isRecording() || $this->shouldIgnore($event)) {
            return;
        }

        Telescope::recordCommand(IncomingEntry::make([
            'command' => $event->command ?? $event->input->getArguments()['command'] ?? 'default',
            'exit_code' => $event->exitCode,
            'arguments' => $event->input->getArguments(),
            'options' => $event->input->getOptions(),
            ...TelescopeHelper::extraData(),
        ]));
    }

    private function shouldIgnore(mixed $event): bool
    {
        return in_array($event->command, array_merge($this->options['ignore'] ?? [], [
            'schedule:run',
            'schedule:finish',
            'package:discover',
        ]));
    }
}
