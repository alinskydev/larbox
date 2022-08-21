<?php

namespace Http\Common\Auth\Requests\Auth;

use App\Http\Requests\FormRequest;
use Modules\User\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public User $user;

    public function nonLocalizedRules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::exists('user')->where('deleted_at', null),
            ],
            'password' => 'required|string|max:255',
        ];
    }

    public function withValidator($validator)
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                $credentials = $this->only('username', 'password');

                if (!Auth::attempt($credentials)) {
                    $validator->errors()->add('password', __('Неправильный :field', ['field' => __('field.password')]));
                }
            });
        }
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $this->user = User::query()->where('username', $this->username)->firstOrFail();
    }
}
