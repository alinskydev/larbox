<?php

namespace Modules\User\Jobs;

use App\Base\Job;
use Illuminate\Support\Facades\Log;
use Modules\User\Enums\NotificationTypeEnum;
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
        $this->queue = 'default';
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
                ->show($show)
                ->extraQuery();

            $userIds = $search->query->get('id')->pluck('id')->toArray();

            NotificationHelper::insertMultiple(
                ownerIds: $userIds,
                type: NotificationTypeEnum::caseByValue($this->data['type']),
                params: [
                    'text' => $this->data['text'],
                ],
                creatorId: $this->creatorId,
            );
        } catch (\Throwable $e) {
            Log::error($e->__toString());
            $this->release(60 * 30);
            return;
        }
    }
}
