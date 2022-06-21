<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\FormRequest;

use App\Helpers\FormRequestHelper;
use App\Helpers\FileHelper;

class SettingsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'admin_email' => 'sometimes|required|email',
            'delete_old_files' => 'sometimes|required|boolean',
            'favicon' => FormRequestHelper::imageRules(),
            'logo' => FormRequestHelper::imageRules(),
            'project_name' => 'sometimes|required|string|max:100',
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
