<?php

namespace Modules\Information\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use Modules\Report\Enums\ReportEnums;
use Modules\Task\Enums\TaskEnums;
use Modules\User\Enums\UserEnums;

class InformationEnumsController extends Controller
{
    public function report()
    {
        $responce = [
            'type' => ReportEnums::types(),
            'date_period_type' => ReportEnums::datePeriodTypes(),
        ];

        return response()->json($responce, 200);
    }

    public function task()
    {
        $responce = [
            'types' => TaskEnums::types(),
            'agent_status' => TaskEnums::agentStatuses(),
            'admin_status' => TaskEnums::adminStatuses(),
        ];

        return response()->json($responce, 200);
    }

    public function user()
    {
        $responce = [
            'roles' => UserEnums::roles(),
        ];

        return response()->json($responce, 200);
    }
}
