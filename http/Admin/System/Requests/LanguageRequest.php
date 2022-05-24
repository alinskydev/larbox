<?php

namespace Http\Admin\System\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\System\Models\Language;

use App\Rules\FileRule;

class LanguageRequest extends ActiveFormRequest
{
    protected array $fileFields = [
        'image' => 'images',
    ];

    public function __construct()
    {
        return parent::__construct(
            model: new Language()
        );
    }

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
