<?php

namespace Modules\System\Http\Admin\Controllers;

use App\Http\Controllers\Controller;

use Modules\System\Models\SystemSettings;
use Modules\System\Resources\SystemSettingsResource;
use Modules\System\Http\Admin\Requests\SystemSettingsRequest;

class SystemSettingsController extends Controller
{
    public function index()
    {
        $responce = SystemSettings::query()->orderBy('name')->get()->keyBy('name');
        $responce = SystemSettingsResource::collection($responce);

        return response()->json($responce, 200);
    }

    public function update(SystemSettingsRequest $request)
    {
        $data = $request->validated();

        $data = array_map(fn ($value, $key) => [
            'name' => $key,
            'value' => $value,
        ], $data, array_keys($data));

        SystemSettings::upsert($data, 'name');

        return $this->index();
    }
}
