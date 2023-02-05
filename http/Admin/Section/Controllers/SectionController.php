<?php

namespace Http\Admin\Section\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

use Modules\Section\Models\Section;
use Modules\Section\Enums\SectionEnum;

class SectionController extends Controller
{
    public Section $model;

    private string $resourceClass;
    private string $requestClass;

    public function __construct()
    {
        $name = request()->route()->parameter('name');

        $this->model = Section::query()->where('name', $name)->firstOrFail();

        $this->resourceClass = SectionEnum::classByPath("$name.resource");
        $this->requestClass = SectionEnum::classByPath("$name.request");

        app()->bind(ValidatesWhenResolved::class, $this->requestClass);
    }

    public function show(): JsonResponse
    {
        $response = array_merge(
            $this->resourceClass::make($this->model->blocks)->resolve(),
            [
                'updated_at' => $this->model->updated_at->format('Y-m-d H:i:s'),
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
