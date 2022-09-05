<?php

namespace Modules\User\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

use Modules\User\Models\User;
use Modules\User\Search\UserSearch;

class NotificationCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $data,
        private int $from,
        private int $to,
        private int $creatorId,
    ) {
        $this->queue = 'user_notification_create';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $filter = $this->data['user_query']['filter'] ?? [];
            $show = $this->data['user_query']['show'] ?? [];

            $query = User::query()->whereBetween('id', [
                $this->from,
                $this->to,
            ]);

            $search = new UserSearch();

            $search->setQueryBuilder($query)
                ->filter($filter, $search::COMBINED_TYPE_AND)
                ->combinedFilter($filter)
                ->show($show);

            $ids = $search->queryBuilder->get('id')->pluck('id')->toArray();

            $insertData = array_map(fn ($value) => [
                'creator_id' => $this->creatorId,
                'owner_id' => $value,
                'type' => $this->data['type'],
                'params' => json_encode([
                    'message' => $this->data['message'],
                ]),
                'created_at' => date('Y-m-d H:i:s'),
            ], $ids);

            if ($insertData) {
                DB::table('user_notification')->insert($insertData);
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
