<?php

namespace Http\Common\Information\Controllers;

use App\Http\Controllers\Controller;
use Modules\System\Resources\SettingsResource;

class SystemController extends Controller
{
    public function index()
    {
        $response = [
            'settings' => SettingsResource::collection(app('settings')->items),
            'languages' => app('language'),
            'translations' => $this->translations(),
        ];

        return response()->json($response, 200);
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
