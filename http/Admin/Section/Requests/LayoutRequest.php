<?php

namespace Http\Admin\Section\Requests;

use Modules\Section\Base\FormRequest;

use App\Helpers\Validation\FileValidationHelper;

class LayoutRequest extends FormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'header_phone' => 'required|string|max:100',
            'footer_phone' => 'required|string|max:100',
        ];
    }

    public function localizedRules()
    {
        return [
            'footer_description' => 'present|nullable|string',
        ];
    }
}
