<?php

namespace Http\Common\Information\Controllers;

use App\Http\Controllers\Controller;
use App\Resources\JsonResource;
use Modules\System\Models\Settings;
use Modules\System\Resources\SettingsResource;
use App\Services\LocalizationService;

class SystemController extends Controller
{
    public function settings()
    {
        $response = Settings::query()->orderBy('name')->get()->keyBy('name');
        $response = SettingsResource::collection($response);

        return response()->json($response, 200);
    }

    public function languages()
    {
        $localizationService = LocalizationService::getInstance();

        $response = [
            'all' => JsonResource::collection($localizationService->allLanguages),
            'active' => JsonResource::collection($localizationService->activeLanguages),
        ];

        return response()->json($response, 200);
    }
}
