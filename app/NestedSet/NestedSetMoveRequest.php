<?php

namespace App\NestedSet;

use App\Base\Model;
use App\Http\Requests\ActiveFormRequest;
use App\Rules\ExistsWithOldRule;
use Illuminate\Validation\Rule;

class NestedSetMoveRequest extends ActiveFormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'type' => [
                'required',
                Rule::in(['before', 'after', 'into']),
            ],
            'id' => [
                'required',
                new ExistsWithOldRule(
                    model: new Model(),
                    query: $this->model->query()->whereNotNull('parent_id'),
                ),
            ],
            'node_id' => [
                'required',
                new ExistsWithOldRule(
                    model: new Model(),
                    query: $this->model->query()->whereNotNull('parent_id'),
                ),
            ],
        ];
    }
}
