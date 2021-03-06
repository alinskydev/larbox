<?php

namespace Http\Admin\Section\Requests;

use Modules\Section\Base\FormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use App\Helpers\Validation\FileValidationHelper;

class ContactRequest extends FormRequest
{
    use SeoMetaFormRequestTrait;

    protected array $relations = ['branches'];

    public function nonLocalizedRules()
    {
        return [
            'social_facebook' => 'present|string|max:100',
            'social_instagram' => 'present|string|max:100',
            'social_youtube' => 'present|string|max:100',

            'branches' => 'array',
            'branches.*.name' => 'required|string|max:100',
            'branches.*.phone' => 'required|string|max:100',
        ];
    }

    public function localizedRules()
    {
        return [
            'branches.*.description' => 'present|string',
        ];
    }
}
