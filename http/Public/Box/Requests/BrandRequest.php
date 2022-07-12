<?php

namespace Http\Public\Box\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\FileValidationHelper;

class BrandRequest extends ActiveFormRequest
{
    protected array $ignoredModelUpdateFields = [
        'file',
        'files_list',
    ];

    public function nonLocalizedRules()
    {
        return [
            'name' => 'required|string|max:100',
            'show_on_the_home_page' => 'required|boolean',
            'file' => FileValidationHelper::rules(FileValidationHelper::CONFIG_ALL),
            'files_list' => 'array',
            'files_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_ALL),
        ];
    }
}
