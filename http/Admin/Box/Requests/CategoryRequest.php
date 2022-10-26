<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;

class CategoryRequest extends ActiveFormRequest
{
    use SeoMetaFormRequestTrait;

    public function localizedRules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule($this->model, extraQuery: function ($query) {
                    $query->where('depth', $this->model->depth ?? 1);
                }),
            ],
        ];
    }
}
