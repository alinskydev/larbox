<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Helpers\Validation\ValidationFileRulesHelper;

class BrandRequest extends ActiveFormRequest
{
    use SeoMetaFormRequestTrait;

    public function nonLocalizedRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule(
                    model: $this->model,
                    fieldIsLocalized: false,
                ),
            ],
            'show_on_the_home_page' => 'required|boolean',
            ...$this->deleteableFileFieldsSingleValidation(
                field: 'file',
                rules: ValidationFileRulesHelper::media(),
            ),
            ...$this->deleteableFileFieldsMultipleValidation(
                field: 'files_list',
                rules: ValidationFileRulesHelper::media(),
            ),
        ];
    }
}
