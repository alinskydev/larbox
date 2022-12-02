<?php

namespace Http\Common\Auth\Requests\Auth;

use App\Base\FormRequest;
use Illuminate\Validation\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'username' => 'required|string|max:100',
            'password' => 'required|string|max:255',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                $credentials = $this->only('username', 'password');

                if (!Auth::attempt($credentials)) {
                    $validator->errors()->add('password', __('Неправильный :field', ['field' => __('fields.password')]));
                }
            });
        }
    }
}
