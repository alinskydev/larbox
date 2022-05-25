<?php

namespace Http\Admin\Storage\Requests;

use App\Http\Requests\FormRequest;

use App\Helpers\FileHelper;
use App\Rules\FileRule;

class FileUploadRequest extends FormRequest
{
    protected array $fileFields = [
        'file',
        'files_list',
    ];

    public array $urls;

    public function rules()
    {
        return [
            'file' => [
                'required_without:files_list',
                new FileRule(mimes: config('larbox.form_request.file.mimes.all'), max: 102400),
            ],
            'files_list' => 'required_without:file|array',
            'files_list.*' => [
                new FileRule(mimes: config('larbox.form_request.file.mimes.all'), max: 102400),
            ],
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
