<?php

namespace App\Rules;

use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;

use App\Models\Model;

class SlugRule extends Rule
{
    public function __construct(
        public Model $model
    ) {
    }

    public function passes($attribute, $value)
    {
        $validator = Validator::make([$attribute => $value], [$attribute => [
            'required',
            'string',
            'max:100',
            ValidationRule::unique($this->model->getTable())->ignore($this->model->id),
        ]]);

        $this->errorMessage = $validator->errors()->first($attribute);

        return !$validator->fails();
    }
}
