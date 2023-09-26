<?php

namespace Http\Admin\System\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use Modules\System\Models\Settings;
use Modules\System\Resources\SettingsResource;
use Http\Admin\System\Requests\SettingsRequest;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index(): JsonResponse
    {
        $response = Settings::query()->orderBy('name')->get()->keyBy('name');
        $response = SettingsResource::collection($response);

        return response()->json($response, 200);
    }

    public function update(SettingsRequest $request): JsonResponse
    {
        $data = $request->validatedData;

        $data = array_map(fn ($value, $key) => [
            'name' => $key,
            'value' => $value,
        ], $data, array_keys($data));

        Settings::upsert($data, 'name');
        Cache::forget('app_settings');

        return $this->successResponse();
    }
}
