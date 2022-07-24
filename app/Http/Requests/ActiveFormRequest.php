<?php

namespace App\Http\Requests;

use App\Models\Model;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Support\Arr;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ActiveFormRequest extends FormRequest
{
    public Model $model;

    public function __construct()
    {
        $this->model = $this->model ?? request()->route('model') ?? request()->route()->bindingFieldFor('new_model');
        return parent::__construct();
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $data = $this->validated();

        DB::beginTransaction();

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $this->model->fillableRelations[$this->model::RELATION_TYPE_ONE_ONE]['seo_meta_morph'] = $data['seo_meta'];
        }

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
