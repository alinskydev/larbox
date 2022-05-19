<?php

namespace Modules\Information\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use App\Resources\JsonResource;
use Modules\System\Models\SystemSettings;
use Modules\System\Resources\SystemSettingsResource;
use App\Services\LocalizationService;

class InformationSystemController extends Controller
{
    public function settings()
    {
        $responce = SystemSettings::query()->orderBy('name')->get()->keyBy('name');
        $responce = SystemSettingsResource::collection($responce);

        return response()->json($responce, 200);
    }

    public function languages()
    {
        $localizationService = LocalizationService::getInstance();

        $responce = [
            'all' => JsonResource::collection($localizationService->allLanguages),
            'active' => JsonResource::collection($localizationService->activeLanguages),
        ];

        return response()->json($responce, 200);
    }
}
