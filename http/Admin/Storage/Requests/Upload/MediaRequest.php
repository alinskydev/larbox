<?php

namespace Http\Admin\Storage\Requests\Upload;

use App\Base\FormRequest;
use App\Helpers\Validation\ValidationFileHelper;

class MediaRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'file' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_MEDIA, true),
        ];
    }
}
