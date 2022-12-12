<?php

namespace Modules\Section\Base;

use App\Http\Requests\ActiveFormRequest;
use Illuminate\Support\Arr;

class FormRequest extends ActiveFormRequest
{
    protected array $relations = [];
    protected array $filesDefaults = [];

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $data = $this->validatedData;

        $oldBlocks = $this->model->blocks;
        $data = array_replace($oldBlocks, $data);

        foreach ($this->relations as $relationName) {
            $data[$relationName] ??= [];

            foreach ($data[$relationName] as $relationKey => &$relationValue) {
                $oldRelationValue = Arr::get($oldBlocks, "$relationName.$relationKey", []);
                $relationValue = array_replace($oldRelationValue, $relationValue);
            }

            $data[$relationName] = array_values($data[$relationName]);
        }

        foreach ($this->filesDefaults as $field => $value) {
            data_fill($data, $field, $value);
        }

        $this->validatedData = $data;
    }
}
