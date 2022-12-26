<?php

namespace Modules\User\Jobs;

use App\Base\Job;
use Modules\User\Helpers\NotificationHelper;
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

            $userIds = $search->query->get('id')->pluck('id')->toArray();

            NotificationHelper::insertMultiple(
                ownerIds: $userIds,
                type: $this->data['type'],
                params: [
                    'text' => $this->data['text'],
                ],
                creatorId: $this->creatorId,
            );
        } catch (\Throwable $e) {
            $this->release(60 * 30);
            return;
        }
    }
}
