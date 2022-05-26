<?php

namespace Http\Admin\Storage\Requests;

use App\Http\Requests\FormRequest;

use App\Helpers\FormRequestHelper;
use App\Helpers\FileHelper;

class FileUploadRequest extends FormRequest
{
    public array $urls;

    public function rules()
    {
        return [
            'file' => FormRequestHelper::fileRules(),
            'files_list' => 'required_without:file|array',
            'files_list.*' => FormRequestHelper::fileRules(),
        ];
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $files = (array)$this->files->get('files_list');
        $files[] = $this->files->get('file');

        $files = array_filter($files);

        foreach ($files as $file) {
            $url = FileHelper::upload($file, 'files');

            $this->urls[] = [
                'relative' => $url,
                'absolute' => asset($url),
            ];
        }
    }
}
