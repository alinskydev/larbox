<?php

namespace Http\Common\Information\Controllers;

use App\Http\Controllers\Controller;

class LocalizationController extends Controller
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
