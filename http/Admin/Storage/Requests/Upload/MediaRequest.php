<?php

namespace Http\Admin\Storage\Requests\Upload;

use App\Http\Requests\FormRequest;

use App\Helpers\FormRequestHelper;
use App\Helpers\FileHelper;

class MediaRequest extends FormRequest
{
    public array $url;

    public function rules()
    {
        return [
            'file' => FormRequestHelper::mediaRules(),
        ];
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $file = $this->files->get('file');

        $url = FileHelper::upload($file, 'media');

        $this->url = [
            'relative' => $url,
            'absolute' => asset($url),
        ];
    }
}
