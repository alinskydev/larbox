<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;

class RoleRequest extends ActiveFormRequest
{
    public function nonLocalizedRules()
    {
        return [];
    }

    public function localizedRules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule($this->model),
            ],
        ];
    }
}
