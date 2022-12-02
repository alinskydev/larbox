<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;
use Illuminate\Support\Arr;

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
                new UniqueRule($this->model, false, extraQuery: function ($query) {
                    if ($this->model->exists) {
                        $siblingsIds = Arr::pluck($this->model->siblings, 'id');
                        $query->whereIn('id', $siblingsIds);
                    } else {
                        $query->where('depth', 1);
                    }
                }),
            ],
        ];
    }
}
