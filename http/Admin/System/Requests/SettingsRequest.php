<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\FormRequest;

use App\Helpers\FileHelper;
use App\Rules\FileRule;

class SettingsRequest extends FormRequest
{
    protected array $fileFields = [
        'favicon',
        'logo',
    ];

    public function rules()
    {
        return [
            'admin_email' => 'sometimes|required|email',
            'favicon' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],
            'logo' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],
            'project_name' => 'sometimes|required|string|max:100',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        foreach ($this->fileFields as $field) {
            if ($file = $this->files->get($field)) {
                $data[$field] = FileHelper::upload($file, 'images');
            }
        }

        return $data;
    }
}
