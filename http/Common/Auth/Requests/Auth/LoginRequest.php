<?php

namespace Http\Common\Auth\Requests\Auth;

use App\Base\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ];
    }

    protected function additionalValidation(): void
    {
        $credentials = $this->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            $this->validator->errors()->add('password', __('Неправильный :field', ['field' => __('fields.password')]));
            return;
        }
    }
}
