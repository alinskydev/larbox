<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class VerifyCodeRequest extends FormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'email' => 'required|email|max:255',
            'reset_password_code' => [
                'required',
                'string',
                Rule::exists('user')->where('deleted_at', null)->where('email', $this->email),
            ],
        ];
    }
}
