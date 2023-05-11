<?php

namespace Http\Website\Box\Controllers;

use App\NestedSet\NestedSetController;
use App\NestedSet\NestedSetHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

use Modules\Box\Models\Category;
use Modules\Box\Search\CategorySearch;
use Modules\Box\Resources\CategoryResource;

class CategoryController extends NestedSetController
{
    public function __construct()
    {
        parent::__construct(
            model: new Category(),
            search: new CategorySearch(),
            resourceClass: CategoryResource::class,
        );

        $this->middleware(function ($request, $next) {
            $this->search->query->withoutTrashed();
            return $next($request);
        });
    }

    public function tree(): JsonResponse
    {
        $response = parent::tree();

        $data = $response->getData(true);
        NestedSetHelper::appendFullFieldToTree($data, 'slug', '/');

        return $response->setData($data);
    }

    public function showByFullSlug(string $fullSlug): JsonResponse
    {
        $slugs = explode('/', $fullSlug);
        $slugs = array_filter($slugs, fn ($value) => $value);
        $lastSlug = array_pop($slugs);

        $possibleModels = $this->search->query->where('slug', $lastSlug)->get();
        $possibleModels = $this->resourceClass::collection($possibleModels)->resolve();
        $possibleModels = Arr::keyBy($possibleModels, 'full_slug');

        $model = Arr::get($possibleModels, $fullSlug);

        if (!$model) abort(404);

        return response()->json($model, 200);
    }
}
