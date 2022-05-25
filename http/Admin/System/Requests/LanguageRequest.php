<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\ActiveFormRequest;

use App\Rules\FileRule;

class LanguageRequest extends ActiveFormRequest
{
    protected array $fileFields = [
        'image',
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'image' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],
        ];
    }
}
