<?php

namespace Http\Admin\Storage\Requests\Upload;

use App\Base\FormRequest;
use App\Helpers\Validation\ValidationFileRulesHelper;

class MediaRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'file' => [
                'required',
                ...ValidationFileRulesHelper::media(),
            ],
        ];
    }
}
