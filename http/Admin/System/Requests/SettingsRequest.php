<?php

namespace Http\Admin\System\Requests;

use App\Base\FormRequest;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\ValidationFileRulesHelper;

class SettingsRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'admin_email' => 'required|email',
            'delete_old_files' => 'required|boolean',
            'favicon' => ValidationFileRulesHelper::image(),
            'logo' => ValidationFileRulesHelper::image(),
            'project_name' => 'required|string|max:255',
        ];
    }
}
