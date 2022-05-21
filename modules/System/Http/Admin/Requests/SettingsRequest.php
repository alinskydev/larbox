<?php

namespace Modules\System\Http\Admin\Requests;

use App\Http\Requests\FormRequest;

use App\Helpers\FileHelper;
use App\Rules\FileRule;
use Illuminate\Support\Arr;

class SettingsRequest extends FormRequest
{
    protected array $fileFields = [
        'favicon' => 'images',
        'logo' => 'images',
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

        $files = $this->files->all();

        foreach ($this->fileFields as $field => $path) {
            $file = Arr::get($files, $field);

            if (!$file) continue;

            $data[$field] = FileHelper::upload($file, $path);
        }

        return $data;
    }
}
