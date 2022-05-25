<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\FileRule;

class BrandRequest extends ActiveFormRequest
{
    protected array $fileFields = [
        'file',
        'files_list',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'file' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.all')),
            ],
            'files_list' => 'array',
            'files_list.*' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.all')),
            ],
        ];
    }
}
