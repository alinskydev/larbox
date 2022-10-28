<?php

namespace App\Hierarchy;

use App\Http\Controllers\ResourceController;
use App\Base\Model;
use App\Base\Search;
use Illuminate\Support\Arr;

class Controller extends ResourceController
{
    public function __construct(
        Model $model,
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

        if (in_array(request()->route()->getActionMethod(), ['index', 'show'])) {
            $this->search->queryBuilder->with(['parent']);
        }
    }

    public function tree()
    {
        $model = $this->model->query()->withoutGlobalScopes()->with('children')->findOrFail(1);
        $data = $this->resourceClass::make($model);

        return response()->json($data, 200);
    }

    public function move(MoveRequest $request)
    {
        $data = $request->validated();

        $model = $this->model->query()->where('depth', '>', 0)->findOrFail($data['id']);
        $parent = $this->model->query()->withoutGlobalScopes()->findOrFail($data['parent_id']);

        // Previous/next nodes

        if ($data['parent_id'] == $model->parent_id) {
            if ($data['position'] > $model->position) {
                $this->model->query()
                    ->where('parent_id', $data['parent_id'])
                    ->whereBetween('position', [$model->position + 1, $data['position']])
                    ->decrement('position', 1);
            } elseif ($data['position'] < $model->position) {
                $this->model->query()
                    ->where('parent_id', $data['parent_id'])
                    ->whereBetween('position', [$data['position'], $model->position - 1])
                    ->increment('position', 1);
            }
        } else {
            $this->model->query()
                ->where('parent_id', $data['parent_id'])
                ->where('position', '>=', $data['position'])
                ->increment('position', 1);

            $this->model->query()
                ->where('parent_id', $model->parent_id)
                ->where('position', '>', $model->position)
                ->decrement('position', 1);
        }

        // Children

        $depthDiff = $parent->depth + 1 - $model->depth;

        if ($depthDiff != 0) {
            $children = Helper::childrenAsList($model);
            $childrenIds = Arr::pluck($children, 'id');

            $this->model->query()->whereIn('id', $childrenIds)->increment('depth', $depthDiff);
        }

        // Self

        $model->parent_id = $data['parent_id'];
        $model->depth += $depthDiff;
        $model->position = $data['position'];
        $model->save();

        return response()->json(['message' => 'Success'], 200);
    }
}
