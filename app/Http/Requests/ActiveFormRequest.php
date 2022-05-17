<?php

namespace App\Http\Requests;

use App\Models\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ActiveFormRequest extends FormRequest
{
    protected array $ignoredModelFields = [];
    
    public function __construct(
        public Model $model
    ) {
    }
    
    protected function prepareForValidation()
    {
        parent::prepareForValidation();
        $this->assignModel();
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        $data = $this->saveFiles($data);

        return $data;
    }

    private function assignModel()
    {
        $routeName = strstr($this->route()->getName(), '.', true);

        $this->model = $this->route($routeName) ?: $this->model;

        $attributes = $this->model->attributesToArray();
        Arr::forget($attributes, $this->ignoredModelFields);

        $this->mergeIfMissing($attributes);
    }

    private function saveFiles(array $data)
    {
        foreach ($this->fileFields as $field => $path) {
            $file = $this->files->get($field);

            if (!$file) continue;

            $path = "storage/uploads/$path/" . date('Y-m-d');

            if (is_array($file)) {
                $data[$field] = $this->model->$field;

                foreach ($file as $f) {
                    $name = md5(uniqid());
                    $extension = $f->getClientOriginalExtension();

                    $f->move($path, "$name.$extension");

                    $data[$field][] = "/$path/$name.$extension";
                }
            } else {
                File::delete(public_path($this->model->$field));

                $name = md5(uniqid());
                $extension = $file->getClientOriginalExtension();

                $file->move($path, "$name.$extension");

                $data[$field] = "/$path/$name.$extension";
            }
        }

        return $data;
    }
}
