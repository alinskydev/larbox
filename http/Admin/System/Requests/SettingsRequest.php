<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\FormRequest;

use App\Helpers\Validation\FileValidationHelper;
use App\Helpers\FileHelper;

class SettingsRequest extends FormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'admin_email' => 'required|email',
            'delete_old_files' => 'required|boolean',
            'favicon' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'logo' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'project_name' => 'required|string|max:255',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $fileFields = [
            'favicon',
            'logo',
        ];

        foreach ($fileFields as $field) {
            if ($file = $this->files->get($field)) {
                $data[$field] = FileHelper::upload($file, 'images');
            }
        }

        return $data;
    }
}
