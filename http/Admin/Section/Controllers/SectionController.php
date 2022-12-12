<?php

namespace Http\Admin\Section\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

use Modules\Section\Models\Section;
use Modules\Section\Enums\SectionEnums;

class SectionController extends Controller
{
    public Section $model;
    private array $config;

    public function __construct()
    {
        $name = request()->route()->parameter('name');

        $this->model = Section::query()->where('name', $name)->firstOrFail();
        $this->config = SectionEnums::config($name);

        app()->bind(ValidatesWhenResolved::class, $this->config['request']);
    }

    public function show(): JsonResponse
    {
        $response = $this->config['resource']::make($this->model->blocks);
        $response['updated_at'] = $this->model->updated_at->format(LARBOX_FORMAT_DATETIME);

        return response()->json($response, 200);
    }

    public function update(ValidatesWhenResolved $request): JsonResponse
    {
        $request->model->safelySave(['blocks' => $request->validatedData]);
        return $this->successResponse();
    }
}
