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
        $response = array_merge(
            $this->config['resource']::make($this->model->blocks)->resolve(),
            [
                'updated_at' => $this->model->updated_at->format(LARBOX_FORMAT_DATETIME),
                'seo_meta' => $this->model->seo_meta,
                'seo_meta_as_array' => $this->model->seo_meta_as_array,
            ],
        );

        return response()->json($response, 200);
    }

    public function update(ValidatesWhenResolved $request): JsonResponse
    {
        $request->model->safelySave(['blocks' => $request->validatedData]);
        return $this->successResponse();
    }
}
