<?php

namespace App\NestedSet;

use App\Http\Requests\ActiveFormRequest;
use Illuminate\Validation\Validator;

class NestedSetMoveRequest extends ActiveFormRequest
{
    public array $nodes;

    public function nonLocalizedRules(): array
    {
        return [
            'tree' => 'required|json',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                $tree = json_decode($this->tree, true);
                $nodes = $this->collectSystemFields($tree);

                if (isset($nodes[1]) || count($nodes) != $this->model->query()->withTrashed()->count() - 1) {
                    $validator->errors()->add('tree', 'Invalid tree');
                }

                $this->nodes = $nodes;
            });
        }
    }

    private function collectSystemFields(
        array $tree,
        int $lft = 2,
        int $rgt = 3,
        int $depth = 1,
        array $result = [],
    ): array {
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
