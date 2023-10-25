<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;
use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;

class CategoryRequest extends ActiveFormRequest
{
    use SeoMetaFormRequestTrait;

    public function localizedRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule(
                    model: $this->model,
                    fieldIsLocalized: true,
                    showDetailedErrorMessage: false,
                    extraQuery: function ($query) {
                        $query->where('parent_id', $this->model->parent_id ?? 1);
                    },
                ),
            ],
        ];
    }
}
