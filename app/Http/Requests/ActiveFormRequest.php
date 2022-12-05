<?php

namespace App\Http\Requests;

use App\Base\FormRequest;
use App\Base\Model;

class ActiveFormRequest extends FormRequest
{
    public Model $model;

    public function __construct()
    {
        $this->model = $this->model ?? request()->route('model') ?? request()->route()->bindingFieldFor('new_model');
        parent::__construct();
    }
}
