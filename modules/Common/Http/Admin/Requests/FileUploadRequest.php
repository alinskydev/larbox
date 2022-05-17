<?php

namespace Modules\Common\Http\Admin\Requests;

use App\Http\Requests\FormRequest;
use App\Helpers\FileHelper;

class FileUploadRequest extends FormRequest
{
    public array $urls;

    public function rules()
    {
        return [
            'file' => 'required_without:files_list|file|max:102400|mimes:jpg,png,webp,doc,docx,xls,pdf',
            'files_list' => 'array',
            'files_list.*' => 'required_without:file|file|max:102400|mimes:jpg,png,webp,doc,docx,xls,pdf',
        ];
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $files = $this->files->get('files_list');
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
