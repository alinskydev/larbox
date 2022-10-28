<?php

namespace Http\Website\Box\Controllers;

use App\Http\Controllers\ResourceController;
use Modules\Box\Models\Category;
use Modules\Box\Search\CategorySearch;
use Modules\Box\Resources\CategoryResource;

use Illuminate\Support\Arr;

class CategoryController extends ResourceController
{
    public function __construct()
    {
        Category::addGlobalScope(function ($query) {
            $query->withoutTrashed();
        });

        parent::__construct(
            model: new Category(),
            search: new CategorySearch(),
            resourceClass: CategoryResource::class,
        );

        if (in_array(request()->route()->getActionMethod(), ['index', 'showByFullSlug'])) {
            $this->search->queryBuilder->with(['parent']);
        }
    }

    public function showByFullSlug(string $fullSlug)
    {
        $slugs = explode('/', $fullSlug);
        $slugs = array_filter($slugs, fn ($value) => $value);
        $lastSlug = array_pop($slugs);

        $possibleModels = $this->search->queryBuilder->where('slug', $lastSlug)->get();
        $possibleModels = $this->resourceClass::collection($possibleModels)->resolve();
        $possibleModels = Arr::keyBy($possibleModels, 'full_slug');

        $model = Arr::get($possibleModels, $fullSlug);

        if (!$model) abort(404);

        return response()->json($model, 200);
    }

    public function tree()
    {
        $model = $this->model->query()->withoutGlobalScopes()->with('children')->findOrFail(1);
        $data = $this->resourceClass::make($model);

        return response()->json($data, 200);
    }
}
