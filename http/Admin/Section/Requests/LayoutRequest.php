<?php

namespace Http\Admin\Section\Requests;

use Modules\Section\Base\FormRequest;

use App\Helpers\Validation\FileValidationHelper;

class LayoutRequest extends FormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'header_phone' => 'required|string|max:255',

            'footer_phone' => 'required|string|max:255',
        ];
    }

    public function localizedRules()
    {
        return [
            'footer_copyright' => 'required|string|max:255',
        ];
    }
}
