<?php

namespace Http\Admin\System\Controllers;

use App\Http\Controllers\Controller;

use Modules\System\Models\Settings;
use Modules\System\Resources\SettingsResource;
use Http\Admin\System\Requests\SettingsRequest;

class SettingsController extends Controller
{
    public function index()
    {
        $response = Settings::query()->orderBy('name')->get()->keyBy('name');
        $response = SettingsResource::collection($response);

        return response()->json($response, 200);
    }

    public function update(SettingsRequest $request)
    {
        $data = $request->validated();

        $data = array_map(fn ($value, $key) => [
            'name' => $key,
            'value' => $value,
        ], $data, array_keys($data));

        Settings::upsert($data, 'name');

        return $this->successResponse();
    }
}
