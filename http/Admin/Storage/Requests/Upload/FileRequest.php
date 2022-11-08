<?php

namespace Http\Admin\Storage\Requests\Upload;

use App\Base\FormRequest;

use App\Helpers\Validation\FileValidationHelper;
use App\Helpers\FileHelper;

class FileRequest extends FormRequest
{
    public array $url;

    public function nonLocalizedRules()
    {
        return [
            'file' => FileValidationHelper::rules(FileValidationHelper::CONFIG_ALL),
        ];
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $file = $this->files->get('file');

        $url = FileHelper::upload($file, 'files');

        $this->url = [
            'relative' => $url,
            'absolute' => asset($url),
        ];
    }
}
