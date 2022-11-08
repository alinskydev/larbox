<?php

namespace Http\Common\System\Controllers;

use App\Base\Controller;
use Modules\System\Resources\SettingsResource;
use Modules\Feedback\Enums\FeedbackEnums;

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
            'feedback' => [
                'statuses' => FeedbackEnums::statuses(),
            ],
        ];

        return response()->json($response, 200);
    }
}
