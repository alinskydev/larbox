<?php

namespace Http\Admin\Storage\Requests\Upload;

use App\Http\Requests\FormRequest;

use App\Helpers\FormRequestHelper;
use App\Helpers\FileHelper;

class FileRequest extends FormRequest
{
    public array $url;

    public function rules()
    {
        return [
            'file' => FormRequestHelper::fileRules(),
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
