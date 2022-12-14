<?php

namespace Modules\User\Jobs;

use App\Base\Job;
use Illuminate\Support\Facades\DB;

use Modules\User\Models\User;
use Modules\User\Search\UserSearch;

class NotificationCreateJob extends Job
{
    public function __construct(
        private array $data,
        private int $from,
        private int $to,
        private int $creatorId,
    ) {
        $this->queue = 'user_notification_create';
    }

    public function handle(): void
    {
        try {
            $filter = $this->data['user_query']['filter'] ?? [];
            $show = $this->data['user_query']['show'] ?? [];

            $query = User::query()->whereBetween('id', [
                $this->from,
                $this->to,
            ]);

            $search = new UserSearch();

            $search->setQuery($query)
                ->filter($filter)
                ->show($show);

            $ids = $search->query->get('id')->pluck('id')->toArray();

            $insertData = array_map(fn ($value) => [
                'creator_id' => $this->creatorId,
                'owner_id' => $value,
                'type' => $this->data['type'],
                'params' => json_encode([
                    'text' => $this->data['text'],
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
}
