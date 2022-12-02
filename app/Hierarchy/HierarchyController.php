<?php

namespace App\Hierarchy;

use App\Http\Controllers\ResourceController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Base\Search;

class HierarchyController extends ResourceController
{
    public function __construct(
        HierarchyModel $model,
        ?Search $search = null,
        ?string $resourceClass = null,
        ?string $formRequestClass = null,
    ) {
        parent::__construct(
            model: $model,
            search: $search,
            resourceClass: $resourceClass,
            formRequestClass: $formRequestClass,
        );

        if (in_array(request()->route()->getActionMethod(), ['index', 'show', 'showByFullSlug'])) {
            $this->search->queryBuilder->with(['parents'])->where('depth', '>', 0);
        }
    }

    public function tree(): JsonResponse
    {
        $model = $this->model->query()->with(['children'])->findOrFail(1);

        $tree = HierarchyHelper::tree($model);
        $tree = HierarchyHelper::appendFullFieldToTree($tree, 'slug', '/');

        return response()->json($tree, 200);
    }

    public function showByFullSlug(string $fullSlug): JsonResponse
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

    public function move(HierarchyMoveRequest $request): JsonResponse
    {
        $queryCases = [];

        foreach ($request->nodes as $key => &$node) {
            $queryCases['lft'][] = "WHEN id = $key THEN " . $node['lft'];
            $queryCases['rgt'][] = "WHEN id = $key THEN " . $node['rgt'];
            $queryCases['depth'][] = "WHEN id = $key THEN " . $node['depth'];
        }

        $this->model->query()->withTrashed()->update([
            'lft' => DB::raw('CASE ' . implode(' ', $queryCases['lft']) . ' ELSE lft END'),
            'rgt' => DB::raw('CASE ' . implode(' ', $queryCases['rgt']) . ' ELSE rgt END'),
            'depth' => DB::raw('CASE ' . implode(' ', $queryCases['depth']) . ' ELSE depth END'),
        ]);

        return $this->successResponse();
    }
}
