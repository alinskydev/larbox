<?php

namespace Modules\System\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\System\Models\SystemLanguage;

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
            'image' => 'nullable|file|max:1024|mimes:jpg,png,webp',
        ];
    }
}
