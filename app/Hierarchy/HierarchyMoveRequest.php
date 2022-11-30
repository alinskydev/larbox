<?php

namespace App\Hierarchy;

use App\Base\FormRequest;

class HierarchyMoveRequest extends FormRequest
{
    public HierarchyModel $model;

    public function __construct()
    {
        $this->model = request()->route()->bindingFieldFor('new_model');
        return parent::__construct();
    }

    public function nonLocalizedRules()
    {
        return [
            'tree' => 'required|json',
        ];
    }
}
