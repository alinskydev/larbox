<?php

namespace App\Http\Requests;

use App\Base\FormRequest;
use App\Base\Model;
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
        parent::__construct();
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();

        if ($this->model->exists && $this->updated_at) {
            if ($this->updated_at != date(LARBOX_FORMAT_DATETIME, strtotime($this->model->updated_at))) {
                abort(409, __('Данные были изменены другим источником. Обновите страницу, чтобы увидеть изменения.'));
            }
        }
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $data = $this->validated();

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $this->model->fillableRelations[$this->model::RELATION_TYPE_ONE_ONE]['seo_meta_morph'] = [
                'value' => Arr::pull($data, 'seo_meta'),
            ];
        }

        DB::beginTransaction();

        try {
            $this->model->fill($data)->touch();
        } catch (\Throwable $e) {
            DB::rollBack();
            abort(400, $e->getMessage());
        }

        DB::commit();
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated($key, $default);
        $data = $this->assignFiles($data);

        return $data;
    }

    private function assignFiles(array $data): array
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
