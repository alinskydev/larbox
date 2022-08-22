<?php

namespace Http\Admin\Section\Requests;

use Modules\Section\Base\FormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use App\Helpers\Validation\FileValidationHelper;

class HomeRequest extends FormRequest
{
    use SeoMetaFormRequestTrait;

    protected array $relations = [
        'relations_1',
        'relations_2',
    ];

    protected array $fileFields = [
        'second_image' => null,
        'second_images_list' => [],
        'relations_1.*.image' => null,
        'relations_1.*.images_list' => [],
    ];

    protected array $localizedFileFields = [
        'second_image_desktop' => null,
        'second_image_tablet' => null,
        'second_image_mobile' => null,
        'relations_2.*.image_desktop' => null,
        'relations_2.*.image_tablet' => null,
        'relations_2.*.image_mobile' => null,
    ];

    public function nonLocalizedRules()
    {
        return [
            'first_text_1' => 'required|string|max:255',
            'first_text_2' => 'present|nullable|string|max:1000',
            'first_text_3' => 'present|nullable|string',

            'second_image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'second_images_list' => 'array',
            'second_images_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),

            'relations_1' => 'required|array',
            'relations_1.*.text' => 'required|string|max:255',
            'relations_1.*.image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'relations_1.*.images_list' => 'array',
            'relations_1.*.images_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),

            'relations_2' => 'array',
        ];
    }

    public function localizedRules()
    {
        return [
            'first_text_1_localized' => 'required|string|max:255',
            'first_text_2_localized' => 'present|nullable|string|max:1000',
            'first_text_3_localized' => 'present|nullable|string',

            'second_image_desktop' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'second_image_tablet' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'second_image_mobile' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),

            'relations_2.*.text_localized' => 'required|string|max:255',
            'relations_2.*.image_desktop' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'relations_2.*.image_tablet' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'relations_2.*.image_mobile' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }
}
