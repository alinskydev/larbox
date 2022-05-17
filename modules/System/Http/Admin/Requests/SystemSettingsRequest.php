<?php

namespace Modules\System\Http\Admin\Requests;

use App\Http\Requests\FormRequest;
use App\Helpers\FileHelper;

class SystemSettingsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'admin_email' => 'sometimes|required|email',
            'favicon' => 'sometimes|file|max:1024|mimes:jpg,png,webp',
            'logo' => 'sometimes|file|max:1024|mimes:jpg,png,webp',
            'project_name' => 'sometimes|required|string|max:100',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        if ($file = $this->files->get('logo')) {
            $data['logo'] = FileHelper::upload($file, 'images');
        }

        if ($file = $this->files->get('favicon')) {
            $data['favicon'] = FileHelper::upload($file, 'images');
        }

        return $data;
    }
}
