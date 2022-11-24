<?php

namespace Modules\Section\Base;

use App\Base\FormRequest as BaseFormRequest;
use App\Base\Model;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Support\Arr;

class FormRequest extends BaseFormRequest
{
    public Model $model;

    protected array $relations = [];
    protected array $fileFields = [];
    protected array $localizedFileFields = [];

    public function __construct()
    {
        $this->model = $this->model ?? request()->route()->controller->model;

        $languages = app('language')->all;

        foreach ($this->localizedFileFields as $field => $value) {
            foreach ($languages as $language) {
                $fileKey = "$field." . $language['code'];
                $this->fileFields[$fileKey] = $value;
            }
        }

        return parent::__construct();
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        if ($this->model->exists && $this->updated_at) {
            if ($this->updated_at != date(LARBOX_FORMAT_DATETIME, strtotime($this->model->updated_at))) {
                abort(409, __('Данные были изменены другим источником. Обновите страницу, чтобы увидеть изменения.'));
            }
        }
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $data = $this->validated();

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $this->model->fillableRelations[$this->model::RELATION_TYPE_ONE_ONE]['seo_meta_morph'] = [
                'value' => Arr::pull($data, 'seo_meta'),
            ];
        }

        $this->model->blocks = $data;
        $this->model->touch();
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        $data = $this->saveFiles($data);

        $oldBlocks = $this->model->getRawOriginal('blocks');
        $oldBlocks = json_decode($oldBlocks, true);

        foreach ($this->fileFields as $path => $defaultValue) {
            if (str_contains($path, '*')) {
                $pathArr = explode('.*.', $path);

                $relation = Arr::pull($pathArr, 0);
                $field = implode('.', $pathArr);

                if (!isset($data[$relation])) continue;

                foreach ($data[$relation] as $dataRelationKey => &$dataRelation) {
                    $oldValue = Arr::get($oldBlocks, "$relation.$dataRelationKey.$field", $defaultValue);
                    data_fill($dataRelation, $field, $oldValue);
                }
            } else {
                $oldValue = Arr::get($oldBlocks, $path, $defaultValue);
                data_fill($data, $path, $oldValue);
            }
        }

        foreach ($this->relations as $relation) {
            data_fill($data, $relation, []);

            if (!str_contains($relation, '.')) {
                $data[$relation] = array_values($data[$relation] ?? []);
            }
        }

        return $data;
    }
}
