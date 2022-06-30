<?php

namespace Http\Public\Box\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Helpers\FormRequestHelper;

class BrandRequest extends ActiveFormRequest
{
    protected array $ignoredModelUpdateFields = [
        'file',
        'files_list',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'show_on_the_home_page' => 'required|boolean',
            'file' => FormRequestHelper::fileRules(),
            'files_list' => 'array',
            'files_list.*' => FormRequestHelper::fileRules(),
        ];
    }
}
