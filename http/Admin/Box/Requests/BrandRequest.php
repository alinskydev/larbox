<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Helpers\Validation\ValidationFileHelper;

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
            'file' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_ALL),
            'files_list' => 'array',
            'files_list.*' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_ALL),
        ];
    }
}
