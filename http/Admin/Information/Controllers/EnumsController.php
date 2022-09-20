<?php

namespace Http\Admin\Information\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Enums\NotificationEnums;
use Modules\User\Helpers\RoleHelper;

class EnumsController extends Controller
{
    public function index()
    {
        $response = [
            'user' => [
                'notification' => [
                    'types' => NotificationEnums::types(),
                ],
                'role' => [
                    'routes' => [
                        'list' => RoleHelper::routesList(false),
                        'tree' => RoleHelper::routesTree(false),
                    ],
                ],
            ],
        ];

        return response()->json($response, 200);
    }
}
