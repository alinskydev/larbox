<?php

namespace App\NestedSet;

use App\Http\Controllers\ResourceController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class NestedSetController extends ResourceController
{
    public function tree(): JsonResponse
    {
        $model = $this->model->query()->with(['children'])->findOrFail(1);
        $tree = NestedSetHelper::tree($model);

        return response()->json($tree, 200);
    }

    public function move(NestedSetMoveRequest $request): JsonResponse
    {
        $queryCases = [];

        foreach ($request->nodes as $key => $node) {
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
