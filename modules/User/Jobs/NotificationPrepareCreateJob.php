<?php

namespace Modules\User\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Modules\User\Models\User;

class NotificationPrepareCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $data,
        private int $creatorId,
    ) {
        $this->queue = 'user_notification_prepare_create';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $usersCount = User::query()->count();

            for ($i = 1; $i < $usersCount; $i += 1000) {
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

    public function retryUntil()
    {
        return now()->addYear();
    }
}
