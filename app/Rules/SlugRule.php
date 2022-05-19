<?php

namespace App\Rules;

use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

use App\Models\Model;

class SlugRule extends Rule
{
    public function __construct(
        public Model $model
    ) {
    }

    public function passes($attribute, $value)
    {
        $data = Arr::undot([$attribute => $value]);

        $validator = Validator::make($data, [$attribute => [
            'string',
            'max:100',
            ValidationRule::unique($this->model->getTable())->ignore($this->model->id),
        ]]);

        $this->errorMessage = $validator->errors()->first($attribute);

        return !$validator->fails();
    }
}
