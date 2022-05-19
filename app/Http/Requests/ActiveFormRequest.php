<?php

namespace App\Http\Requests;

use App\Helpers\FileHelper;
use App\Models\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ActiveFormRequest extends FormRequest
{
    protected array $ignoredModelFields = [];

    public function __construct(
        public Model $model
    ) {
        $this->ignoredModelFields = array_merge($this->ignoredModelFields, array_keys($this->fileFields));
        return parent::__construct();
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $data = $this->validationData();

        $routeName = strstr($this->route()->getName(), '.', true);
        $this->model = $this->route($routeName) ?: $this->model;

        $relationsAttributes = array_map(fn ($value) => $value->attributesToArray(), $this->model->getRelations());
        $attributes = array_merge($this->model->attributesToArray(), $relationsAttributes);

        Arr::forget($attributes, $this->ignoredModelFields);

        $data = array_replace_recursive($attributes, $data);

        $this->merge($data);
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
