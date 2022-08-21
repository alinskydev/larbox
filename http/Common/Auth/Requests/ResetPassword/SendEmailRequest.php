<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Http\Requests\FormRequest;
use Modules\User\Models\User;
use Illuminate\Validation\Rule;

class SendEmailRequest extends FormRequest
{
    public User $user;

    public function nonLocalizedRules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
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
