<?php

namespace Modules\Auth\Http\Public\Requests;

use App\Http\Requests\FormRequest;
use Modules\User\Models\User;
use Illuminate\Validation\Rule;

class AuthResetPasswordRequest extends FormRequest
{
    public User $user;

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
            'new_password' => 'required|string|min:8|max:100',
            'new_password_confirmation' => 'required|same:new_password',
        ];
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $this->user = User::query()->where('email', $this->email)->firstOrFail();
    }
}
