<?php

namespace Http\Admin\System\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Helpers\RoleHelper;

use Modules\Feedback\Enums\FeedbackEnums;
use Modules\User\Enums\NotificationEnums;

class SystemController extends Controller
{
    public function information()
    {
        $response = [
            'enums' => $this->enums(),
            'translations' => $this->translations(),
        ];

        return response()->json($response, 200);
    }

    private function enums()
    {
        return [
            'feedback' => [
                'statuses' => FeedbackEnums::statuses(),
            ],
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
    }

    private function translations()
    {
        return app('language')->all->map(function ($value, $key) {
            $path = lang_path($value->code);

            return [
                'fields' => require("$path/fields.php"),
            ];
        });
    }
}
