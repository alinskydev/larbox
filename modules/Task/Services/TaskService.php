<?php

namespace Modules\Task\Services;

use App\Services\ActiveService;
use Modules\Task\Models\Task;
use Illuminate\Support\Facades\DB;
use Modules\Task\Enums\TaskEnums;

class TaskService extends ActiveService
{
    public static function countingsByAgentStatuses(?int $agentId = null)
    {
        $query = Task::query();

        if ($agentId) {
            $query->where('agent_id', $agentId);
        }

        $countings = $query->select(['agent_status', DB::raw('COUNT(*) as total_count')])
            ->groupBy('agent_status')
            ->get()
            ->pluck('total_count', 'agent_status')
            ->toArray();

        $statuses = TaskEnums::agentStatuses();

        foreach ($statuses as $status => &$value) {
            $value = $countings[$status] ?? 0;
        }

        return $statuses;
    }

    public static function countingsByAdminStatuses(?int $agentId = null)
    {
        $query = Task::query();

        if ($agentId) {
            $query->where('agent_id', $agentId);
        }

        $countings = $query->select(['admin_status', DB::raw('COUNT(*) as total_count')])
            ->groupBy('admin_status')
            ->get()
            ->pluck('total_count', 'admin_status')
            ->toArray();

        $statuses = TaskEnums::adminStatuses();

        foreach ($statuses as $status => &$value) {
            $value = $countings[$status] ?? 0;
        }

        return $statuses;
    }
}
