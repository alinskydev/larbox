<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class VerifyCodeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::exists('user')->where('deleted_at', null),
            ],
            'reset_password_code' => [
                'required',
                'string',
                'size:8',
                Rule::exists('user')->where('deleted_at', null)->where('email', $this->email),
            ],
        ];
    }
}
