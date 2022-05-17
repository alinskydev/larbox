<?php

namespace Modules\Information\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Report\Models\Report;
use Modules\Shop\Models\Shop;
use Modules\Task\Models\Task;
use Modules\User\Models\UserMessage;
use Modules\Task\Services\TaskService;

class InformationStatisticsController extends Controller
{
    public function countings()
    {
        $userId = auth()->user()->id;

        $reportedShopsCurrentMonthCount = Report::query()
            ->where('creator_id', $userId)
            ->whereBetween('date_period_to', [date('01.m.Y'), date('t.m.Y')])
            ->select([DB::raw('DISTINCT(shop_id)')])
            ->get()
            ->count();

        $responce = [
            'shops' => [
                'total' => Shop::query()->where('agent_id', $userId)->count(),
                'active' => Shop::query()->where('agent_id', $userId)->where('is_active', 1)->count(),
                'reported_current_month' => $reportedShopsCurrentMonthCount,
            ],
            'tasks' => [
                'total' => Task::query()->where('agent_id', $userId)->count(),
                'by_agent_statuses' => TaskService::countingsByAgentStatuses($userId),
                'by_admin_statuses' => TaskService::countingsByAdminStatuses($userId),
            ],
            'messages' => [
                'unseen' => UserMessage::query()
                    ->where('user_id', $userId)
                    ->where('is_sent_by_admin', 1)
                    ->where('is_seen', 0)
                    ->count(),
            ],
        ];

        return response()->json($responce, 200);
    }
}
