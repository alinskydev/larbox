<?php

namespace Modules\User\Jobs;

use App\Base\Job;
use Illuminate\Support\Facades\Log;
use Modules\User\Models\User;

class NotificationPrepareCreateJob extends Job
{
    public function __construct(
        private array $data,
        private int $creatorId,
    ) {
        $this->queue = 'default';
    }

    public function handle(): void
    {
        try {
            $batchSize = 1000;

            $maxId = User::query()->max('id');

            for ($i = 1; $i <= $maxId; $i += $batchSize) {
                NotificationCreateJob::dispatch(
                    data: $this->data,
                    from: $i,
                    to: $i + $batchSize - 1,
                    creatorId: $this->creatorId,
                );
            }
        } catch (\Throwable $e) {
            Log::error($e->__toString());
            $this->release(60 * 30);
            return;
        }
    }
}
