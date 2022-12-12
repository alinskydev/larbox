<?php

namespace Http\Admin\System\Requests;

use App\Base\FormRequest;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\ValidationFileHelper;

class SettingsRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'admin_email' => 'required|email',
            'delete_old_files' => 'required|boolean',
            'favicon' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_IMAGE),
            'logo' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_IMAGE),
            'project_name' => 'required|string|max:255',
        ];
    }
}
