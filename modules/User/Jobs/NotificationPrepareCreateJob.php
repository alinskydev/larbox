<?php

namespace Modules\User\Jobs;

use App\Base\Job;
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
            $maxId = User::query()->max('id');

            for ($i = 1; $i <= $maxId; $i += 1000) {
                NotificationCreateJob::dispatch(
                    data: $this->data,
                    from: $i,
                    to: $i + 999,
                    creatorId: $this->creatorId,
                );
            }
        } catch (\Throwable $e) {
            $this->release(60 * 30);
            return;
        }
    }
}
