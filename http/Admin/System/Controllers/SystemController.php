<?php

namespace Http\Admin\System\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Enums\NotificationEnums;
use Modules\User\Helpers\RoleHelper;

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
