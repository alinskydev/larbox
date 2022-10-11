<?php

namespace Http\Website\Feedback\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Feedback\Models\Callback;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\FileValidationHelper;

class CallbackRequest extends ActiveFormRequest
{
    public function __construct()
    {
        $this->model = new Callback();
        return parent::__construct();
    }

    public function nonLocalizedRules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'present|nullable|string|max:255',
        ];
    }
}
