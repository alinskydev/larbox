<?php

namespace Modules\Section\Requests;

use Modules\Section\Base\FormRequest;
use App\Helpers\Validation\FileValidationHelper;

class HomeRequest extends FormRequest
{
    protected array $relations = ['slider', 'portfolio'];

    protected array $fileFields = [
        'welcome_image' => null,
        'images_list' => [],
        'slider.*.image' => null,
        'portfolio.*.images_list' => [],
    ];

    public function nonLocalizedRules()
    {
        return [
            'welcome_slogan' => 'required|string|max:100',
            'welcome_image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'images_list' => 'array',
            'images_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),

            'slider' => 'required|array',
            'slider.*.image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),

            'portfolio' => 'required|array',
            'portfolio.*.name' => 'required|string|max:100',
            'portfolio.*.images_list' => 'array',
            'portfolio.*.images_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }

    public function localizedRules()
    {
        return [
            'welcome_title' => 'required|string|max:100',
            'welcome_description' => 'present|string',

            'slider.*.title' => 'required|string|max:100',
            'slider.*.subtitle' => 'required|string|max:100',

            'portfolio.*.description' => 'present|string',
        ];
    }
}
