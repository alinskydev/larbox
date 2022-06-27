<?php

namespace App\Http\Requests;

use App\Models\Model;
use Illuminate\Support\Arr;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ActiveFormRequest extends FormRequest
{
    public Model $model;

    protected array $ignoredModelUpdateFields = [];

    public function __construct()
    {
        $this->model = $this->model ?? request()->route('model') ?? request()->route()->bindingFieldFor('new_model');
        return parent::__construct();
    }

    protected function prepareForValidation()
    {
        // Assigning model and its fields

        $relationsAttributes = array_map(fn ($value) => $value->attributesToArray(), $this->model->getRelations());
        $attributes = array_replace_recursive($this->model->attributesToArray(), $relationsAttributes);

        Arr::forget($attributes, $this->ignoredModelUpdateFields);

        // Preparing

        parent::prepareForValidation();

        $data = $this->validationData();
        $data = array_replace_recursive($attributes, $data);

        array_walk_recursive($data, function (&$value, $key) {
            if ($value === '') $value = null;
        });

        $this->merge($data);
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $data = $this->validated();

        DB::beginTransaction();
        $this->model->fill($data)->touch();
        DB::commit();
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        $data = $this->assignFiles($data);

        return $data;
    }

    private function assignFiles($data)
    {
        $data = Arr::dot($data);

        foreach ($data as $field => $value) {
            if (!($value instanceof UploadedFile)) continue;

            unset($data[$field]);

            $fieldArr = explode('.', $field);
            $fieldIndex = end($fieldArr);

            if (is_numeric($fieldIndex)) {
                array_pop($fieldArr);
                $field = implode('.', $fieldArr);
                $field .= ".new.$fieldIndex";
                $data[$field] = $value;
            } else {
                $field .= '.new';
                $data[$field] = $value;
            }
        }

        $data = Arr::undot($data);

        return $data;
    }
}
