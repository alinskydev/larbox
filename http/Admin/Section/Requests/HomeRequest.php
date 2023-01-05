<?php

namespace Http\Admin\Section\Requests;

use Modules\Section\Base\FormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use App\Helpers\Validation\ValidationFileRulesHelper;

class HomeRequest extends FormRequest
{
    use SeoMetaFormRequestTrait;

    protected array $relations = [
        'relations_1',
        'relations_2',
    ];

    protected array $filesDefaults = [
        'relations_1.*.image' => null,
        'relations_2.*.images_list' => [],
    ];

    public function nonLocalizedRules(): array
    {
        return [
            'first_text_1' => 'required|string|max:255',
            'first_text_2' => 'present|nullable|string',
            'first_text_3' => 'present|nullable|string',

            'second_image_desktop' => ValidationFileRulesHelper::image(),
            'second_image_tablet' => ValidationFileRulesHelper::image(),
            'second_image_mobile' => ValidationFileRulesHelper::image(),
            'second_images_list' => 'array',
            'second_images_list.*' => ValidationFileRulesHelper::image(),

            'relations_1' => 'required|array',
            'relations_1.*.text' => 'required|string|max:255',
            'relations_1.*.image' => ValidationFileRulesHelper::image(),

            'relations_2' => 'array',
            'relations_2.*.images_list' => 'array',
            'relations_2.*.images_list.*' => ValidationFileRulesHelper::image(),
        ];
    }

    public function localizedRules(): array
    {
        return [
            'first_text_1_localized' => 'required|string|max:255',
            'first_text_2_localized' => 'present|nullable|string',
            'first_text_3_localized' => 'present|nullable|string',

            'relations_2.*.text_localized' => 'required|string',
        ];
    }
}
