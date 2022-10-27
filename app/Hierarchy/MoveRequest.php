<?php

namespace App\Hierarchy;

use App\Http\Requests\FormRequest;

use Illuminate\Validation\Rule;

class MoveRequest extends FormRequest
{
    public Model $model;

    public function __construct()
    {
        $this->model = request()->route()->bindingFieldFor('new_model');
        return parent::__construct();
    }

    public function nonLocalizedRules()
    {
        return [
            'id' => [
                'required',
                Rule::exists($this->model->getTable(), 'id')->withoutTrashed(),
            ],
            'parent_id' => [
                'required',
                Rule::exists($this->model->getTable(), 'id')->withoutTrashed(),
            ],
            'position' => 'required|integer|min:0',
        ];
    }
}
