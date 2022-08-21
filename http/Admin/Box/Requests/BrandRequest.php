<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\FileValidationHelper;

class BrandRequest extends ActiveFormRequest
{
    use SeoMetaFormRequestTrait;

    public function nonLocalizedRules()
    {
        return [
            'name' => 'required|string|max:255',
            'show_on_the_home_page' => 'required|boolean',
            'file' => FileValidationHelper::rules(FileValidationHelper::CONFIG_ALL),
            'files_list' => 'array',
            'files_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_ALL),
        ];
    }
}
