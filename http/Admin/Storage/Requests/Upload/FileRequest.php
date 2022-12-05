<?php

namespace Http\Admin\Storage\Requests\Upload;

use App\Base\FormRequest;
use App\Helpers\Validation\FileValidationHelper;

class FileRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'file' => FileValidationHelper::rules(FileValidationHelper::CONFIG_ALL, true),
        ];
    }
}
