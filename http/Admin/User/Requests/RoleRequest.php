<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;

class RoleRequest extends ActiveFormRequest
{
    public function __construct()
    {
        parent::__construct();

        if ($this->model->exists && $this->model->id === 1) {
            abort(403, __('Редактирование данной записи запрещено'));
        }
    }

    public function nonLocalizedRules(): array
    {
        return [
            'routes' => 'array',
            'routes.*' => 'required|string',
        ];
    }

    public function localizedRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule(
                    model: $this->model,
                    fieldIsLocalized: true,
                ),
            ],
        ];
    }
}
