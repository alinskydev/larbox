<?php

namespace App\NestedSet;

use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NestedSetController extends ResourceController
{
    public function tree(): Response
    {
        $model = $this->model->query()->with(['children'])->findOrFail(1);
        $tree = NestedSetHelper::tree($model);

        return response()->json($tree, 200);
    }

    public function move(NestedSetMoveRequest $request): Response
    {
        $queryCases = array_map(fn ($value) => "WHEN id = ? THEN ?", $request->nodes);

        $bindings = [];

        foreach ($request->nodes as $key => $node) {
            $bindings['lft'][] = $key;
            $bindings['lft'][] = $node['lft'];
            $bindings['rgt'][] = $key;
            $bindings['rgt'][] = $node['rgt'];
            $bindings['depth'][] = $key;
            $bindings['depth'][] = $node['depth'];
        }

        $bindings = array_merge(...array_values($bindings));

        $this->model->query()
            ->setBindings($bindings)
            ->where('id', '!=', 1)
            ->getQuery()
            ->update([
                'lft' => DB::raw('CASE ' . implode(' ', $queryCases) . ' ELSE lft END'),
                'rgt' => DB::raw('CASE ' . implode(' ', $queryCases) . ' ELSE rgt END'),
                'depth' => DB::raw('CASE ' . implode(' ', $queryCases) . ' ELSE depth END'),
            ]);

        return $this->successResponse();
    }
}
