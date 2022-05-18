<?php

namespace Modules\System\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\System\Models\SystemLanguage;

use App\Rules\FileRule;

class SystemLanguageRequest extends ActiveFormRequest
{
    protected array $ignoredModelFields = ['image'];
    protected array $fileFields = [
        'image' => 'images',
    ];

    public function __construct()
    {
        return parent::__construct(
            model: new SystemLanguage()
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
