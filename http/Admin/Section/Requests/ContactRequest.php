<?php

namespace Http\Admin\Section\Requests;

use Modules\Section\Base\FormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use App\Helpers\Validation\ValidationFileRulesHelper;

class ContactRequest extends FormRequest
{
    use SeoMetaFormRequestTrait;

    protected array $relations = [
        'branches',
    ];

    protected array $defaults = [
        'branches.*.phones' => [],
    ];

    public function nonLocalizedRules(): array
    {
        return [
            'socials_facebook' => 'present|nullable|string|max:255',
            'socials_instagram' => 'present|nullable|string|max:255',
            'socials_youtube' => 'present|nullable|string|max:255',

            'branches' => 'array',
            'branches.*.name' => 'required|string|max:255',
            'branches.*.phones' => 'array',
            'branches.*.phones.*' => 'required|string|max:255',
        ];
    }

    public function localizedRules(): array
    {
        return [
            'branches.*.description' => 'present|nullable|string',
        ];
    }
}
