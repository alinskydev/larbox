<?php

namespace App\Http\Requests;

use App\Base\FormRequest;
use App\Http\Requests\ActiveFormRequest\DeleteableFileFieldsTrait;
use App\Base\Model;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;
use Illuminate\Support\Arr;

class ActiveFormRequest extends FormRequest
{
    use DeleteableFileFieldsTrait;

    protected const FILE_FIELDS_TYPE_SINGLE = 'FILE_FIELDS_TYPE_SINGLE';
    protected const FILE_FIELDS_TYPE_MULTIPLE = 'FILE_FIELDS_TYPE_MULTIPLE';

    public Model $model;

    public function __construct()
    {
        $this->model ??= request()->route('model') ?? request()->route()->controller->model;
        parent::__construct();
    }

    public function rules(): array
    {
        $rules = parent::rules();

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $seoMetaRules = $this->seoMetaRules();
            $locales = array_keys(app('language')->all);

            foreach ($seoMetaRules as $key => $rule) {
                foreach ($locales as $locale) {
                    $rules["$key.$locale"] = $rule;
                }
            }
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();

        if (
            $this->model->exists &&
            $this->updated_at &&
            $this->updated_at != date(LARBOX_FORMAT_DATETIME, strtotime($this->model->updated_at))
        ) {
            abort(409, __('Данные были изменены другим источником. Обновите страницу, чтобы увидеть изменения.'));
        }
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $this->deleteableFileFieldsProcess();

        if (in_array(SeoMetaFormRequestTrait::class, class_uses_recursive($this))) {
            $this->model->fillRelations(
                oneToOne: [
                    'seo_meta_morph' => [
                        'value' => Arr::pull($this->validatedData, 'seo_meta'),
                    ],
                ],
            );
        }
    }
}
