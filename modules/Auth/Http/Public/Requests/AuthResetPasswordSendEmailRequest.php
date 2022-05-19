<?php

namespace Modules\Auth\Http\Public\Requests;

use App\Http\Requests\FormRequest;
use Modules\User\Models\User;
use Illuminate\Validation\Rule;

class AuthResetPasswordSendEmailRequest extends FormRequest
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
        ];
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $this->user = User::query()->where('email', $this->email)->firstOrFail();
    }
}
