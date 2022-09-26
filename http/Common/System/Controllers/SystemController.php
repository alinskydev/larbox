<?php

namespace Http\Common\System\Controllers;

use App\Http\Controllers\Controller;
use Modules\System\Resources\SettingsResource;
use Modules\User\Enums\NotificationEnums;

class SystemController extends Controller
{
    public function information()
    {
        $response = [
            'settings' => SettingsResource::collection(app('settings')->items),
            'languages' => app('language'),
        ];

        return response()->json($response, 200);
    }

    public function enums()
    {
        $response = [
            'user' => [
                'notification' => [
                    'types' => NotificationEnums::types(),
                ],
            ],
        ];

        return response()->json($response, 200);
    }
}
