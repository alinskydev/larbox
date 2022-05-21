<?php

namespace Modules\Information\Http\Public\Controllers;

use App\Http\Controllers\Controller;

class InformationLocalizationController extends Controller
{
    public function messages(string $type)
    {
        $locale = app()->getLocale();
        $file = lang_path("$locale/api/$type.php");

        if (!is_file($file)) {
            abort(404, 'Messages file not found');
        }

        $response = require($file);

        return response()->json($response, 200);
    }
}
