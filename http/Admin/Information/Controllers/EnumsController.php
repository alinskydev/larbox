<?php

namespace Http\Admin\Information\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Enums\NotificationEnums;

class EnumsController extends Controller
{
    public function index()
    {
        $response = [
            'user_notification' => [
                'types' => NotificationEnums::types(),
            ],
        ];

        return response()->json($response, 200);
    }
}
