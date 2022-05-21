<?php

namespace App\Http\Requests;

use App\Helpers\FileHelper;
use App\Models\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ActiveFormRequest extends FormRequest
{
    public Model $model;

    protected array $ignoredModelUpdateFields = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->ignoredModelUpdateFields = array_merge($this->ignoredModelUpdateFields, array_keys($this->fileFields));

        return parent::__construct();
    }

    protected function prepareForValidation()
    {
        // Assigning model and its fields

        $this->model = $this->route('model') ?: $this->model;

        $relationsAttributes = array_map(fn ($value) => $value->attributesToArray(), $this->model->getRelations());
        $attributes = array_replace_recursive($this->model->attributesToArray(), $relationsAttributes);

        Arr::forget($attributes, $this->ignoredModelUpdateFields);

        // Preparing

        parent::prepareForValidation();

        $data = $this->validationData();
        $data = array_replace_recursive($attributes, $data);

        $this->merge($data);
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $data = $this->validated();

        $this->model->fill($data)->save();
        $this->model->refresh();
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        $data = $this->saveFiles($data);

        return $data;
    }

    private function saveFiles(array $data)
    {
        $files = $this->files->all();

        foreach ($this->fileFields as $field => $path) {
            $file = Arr::get($files, $field);

            if (!$file) continue;

            $fieldArr = explode('.', $field);
            $oldValue = clone ($this->model);

            foreach ($fieldArr as $fieldName) {
                $oldValue = $oldValue ? $oldValue->$fieldName : $oldValue;
            }

            if (is_array($file)) {
                $file = array_values($file);

                Arr::set($data, $field, $oldValue);

                foreach ($file as $k => $f) {
                    Arr::set($data, "$field.$k", FileHelper::upload($f, $path));
                }
            } else {
                File::delete(public_path($oldValue));

                Arr::set($data, $field, FileHelper::upload($file, $path));
            }
        }

        return $data;
    }
}
