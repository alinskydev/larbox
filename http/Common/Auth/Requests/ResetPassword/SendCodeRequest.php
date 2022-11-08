<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Base\FormRequest;

use Illuminate\Validation\Rule;

class SendCodeRequest extends FormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::exists('user')->withoutTrashed(),
            ],
        ];
    }
}
