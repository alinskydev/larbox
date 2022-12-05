<?php

namespace Http\Admin\System\Requests;

use App\Base\FormRequest;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\FileValidationHelper;

class SettingsRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'admin_email' => 'required|email',
            'delete_old_files' => 'required|boolean',
            'favicon' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'logo' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'project_name' => 'required|string|max:255',
        ];
    }
}
