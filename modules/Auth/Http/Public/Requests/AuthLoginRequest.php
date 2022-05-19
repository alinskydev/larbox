<?php

namespace Modules\Auth\Http\Public\Requests;

use App\Http\Requests\FormRequest;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthLoginRequest extends FormRequest
{
    public User $user;

    public function rules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:100',
                Rule::exists('user')->where('deleted_at', null),
            ],
            'password' => 'required|string|max:100',
        ];
    }

    public function withValidator($validator)
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                $credentials = $this->only('username', 'password');

                if (!Auth::attempt($credentials)) {
                    $validator->errors()->add('password', __('rule.invalid', ['field' => __('field.password')]));
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
