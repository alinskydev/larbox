<?php

namespace App\Hierarchy;

use App\Http\Controllers\ResourceController;
use App\Base\Search;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

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

    public function tree()
    {
        $model = $this->model->query()->with(['children'])->findOrFail(1);

        $tree = HierarchyHelper::tree($model);
        $tree = HierarchyHelper::appendFullFieldToTree($tree, 'slug', '/');

        return response()->json($tree, 200);
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

    public function move(HierarchyMoveRequest $request)
    {
        try {
            $data = $request->validated();

            $tree = json_decode($data['tree'], true);
            $nodes = $this->collectSystemFields($tree);

            if (isset($nodes[1]) || count($nodes) != $this->model->query()->withTrashed()->count() - 1) {
                throw new \Exception('Invalid node');
            }

            foreach ($nodes as $key => &$node) {
                $queryCases['lft'][] = "WHEN id = $key THEN " . $node['lft'];
                $queryCases['rgt'][] = "WHEN id = $key THEN " . $node['rgt'];
                $queryCases['depth'][] = "WHEN id = $key THEN " . $node['depth'];
            }
        } catch (\Throwable $e) {
            abort(400, 'Invalid node');
        }

        $this->model->query()->withTrashed()->update([
            'lft' => DB::raw('CASE ' . implode(' ', $queryCases['lft']) . ' ELSE lft END'),
            'rgt' => DB::raw('CASE ' . implode(' ', $queryCases['rgt']) . ' ELSE rgt END'),
            'depth' => DB::raw('CASE ' . implode(' ', $queryCases['depth']) . ' ELSE depth END'),
        ]);

        return $this->successResponse();
    }

    private function collectSystemFields(array $tree, int $lft = 2, int $rgt = 3, int $depth = 1, array $result = [])
    {
        foreach ($tree as $node) {
            $nodeId = $node['id'];

            $result[$nodeId] = [
                'lft' => $lft,
                'rgt' => $rgt,
                'depth' => $depth,
            ];

            if ($node['children']) {
                $childrenCount = 0;

                array_walk_recursive($node['children'], function ($value, $key) use (&$childrenCount) {
                    if ($key == 'id') $childrenCount++;
                });

                $result[$nodeId]['rgt'] += $childrenCount * 2;

                $result += $this->collectSystemFields($node['children'], $lft + 1, $rgt + 1, $depth + 1, $result);

                $lft = $result[$nodeId]['rgt'] + 1;
                $rgt = $result[$nodeId]['rgt'] + 2;
            } else {
                $lft += 2;
                $rgt += 2;
            }
        }

        return $result;
    }
}
