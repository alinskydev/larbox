<?php

namespace App\Telescope\Watchers;

use App\Telescope\Helpers\TelescopeHelper;
use Laravel\Telescope\Watchers\JobWatcher as BaseJobWatcher;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\EntryUpdate;
use Laravel\Telescope\ExceptionContext;
use Laravel\Telescope\Telescope;

class JobWatcher extends BaseJobWatcher
{
    public function recordProcessedJob(JobProcessed $event): void
    {
        if (!Telescope::isRecording()) {
            return;
        }

        $uuid = $event->job->payload()['telescope_uuid'] ?? null;

        if (!$uuid) {
            return;
        }

        Telescope::recordUpdate(EntryUpdate::make(
            $uuid,
            EntryType::JOB,
            [
                'status' => 'processed',
                ...TelescopeHelper::extraData(),
            ]
        ));

        $this->updateBatch($event->job->payload());
    }

    public function recordFailedJob(JobFailed $event): void
    {
        if (!Telescope::isRecording()) {
            return;
        }

        $uuid = $event->job->payload()['telescope_uuid'] ?? null;

        if (!$uuid) {
            return;
        }

        Telescope::recordUpdate(EntryUpdate::make(
            $uuid,
            EntryType::JOB,
            [
                'status' => 'failed',
                'exception' => [
                    'message' => $event->exception->getMessage(),
                    'trace' => $event->exception->getTrace(),
                    'line' => $event->exception->getLine(),
                    'line_preview' => ExceptionContext::get($event->exception),
                ],
                ...TelescopeHelper::extraData(),
            ]
        )->addTags(['failed']));

        $this->updateBatch($event->job->payload());
    }
}
