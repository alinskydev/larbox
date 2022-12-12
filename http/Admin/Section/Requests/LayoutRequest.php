<?php

namespace Http\Admin\Section\Requests;

use Modules\Section\Base\FormRequest;

use App\Helpers\Validation\ValidationFileHelper;

class LayoutRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'header_phone' => 'required|string|max:255',

            'footer_phone' => 'required|string|max:255',
        ];
    }

    public function localizedRules(): array
    {
        return [
            'footer_copyright' => 'required|string|max:255',
        ];
    }
}
