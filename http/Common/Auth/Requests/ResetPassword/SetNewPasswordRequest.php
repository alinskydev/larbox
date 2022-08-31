<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Http\Requests\FormRequest;
use Modules\User\Models\User;
use Illuminate\Validation\Rule;

class SetNewPasswordRequest extends FormRequest
{
    public User $user;

    public function nonLocalizedRules()
    {
        return [
            'email' => 'required|email|max:255',
            'reset_password_code' => [
                'required',
                'string',
                Rule::exists('user')->where('email', $this->email)->withoutTrashed(),
            ],
            'new_password' => 'required|string|min:8|max:255',
            'new_password_confirmation' => 'required|same:new_password',
        ];
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $this->user = User::query()->where('email', $this->email)->firstOrFail();
    }
}
