<?php

namespace Http\Common\Information\Controllers;

use App\Http\Controllers\Controller;
use Modules\System\Models\Settings;
use Modules\System\Resources\SettingsResource;
use App\Services\LocalizationService;

class SystemController extends Controller
{
    public function index()
    {
        $languages = $this->languages();

        $response = [
            'settings' => $this->settings(),
            'languages' => $languages,
            'translations' => $this->translations($languages['active']->toArray()),
        ];

        return response()->json($response, 200);
    }

    private function settings()
    {
        $result = Settings::query()->orderBy('name')->get()->keyBy('name');
        return SettingsResource::collection($result);
    }

    private function languages()
    {
        $localizationService = LocalizationService::getInstance();

        return [
            'all' => $localizationService->allLanguages,
            'active' => $localizationService->activeLanguages,
            'main' => $localizationService->mainLanguage,
        ];
    }

    private function translations(array $languages)
    {
        return array_map(function ($value) {
            $path = lang_path($value['code']);

            return [
                'field' => require("$path/field.php"),
            ];
        }, $languages);
    }
}
