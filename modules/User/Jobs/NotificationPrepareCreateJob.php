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
        $this->queue = 'user_notification_prepare_create';
    }

    public function handle(): void
    {
        try {
            $usersCount = User::query()->count();

            for ($i = 1; $i <= $usersCount; $i += 1000) {
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
