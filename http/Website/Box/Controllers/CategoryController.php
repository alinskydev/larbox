<?php

namespace Http\Website\Box\Controllers;

use App\NestedSet\NestedSetController;
use App\NestedSet\NestedSetHelper;
use Http\Website\Box\Filters\CategoryFilter;
use Symfony\Component\HttpFoundation\Response;
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
            filter: new CategoryFilter(),
            resourceClass: CategoryResource::class,
        );
    }

    public function tree(): Response
    {
        $tree = $this->model->query()
            ->get()
            ->toTree(1)
            ->toArray();

        NestedSetHelper::appendFullFieldToTree($tree, 'slug', '/');

        return response()->json($tree);
    }

    public function showByFullSlug(string $fullSlug): Response
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
