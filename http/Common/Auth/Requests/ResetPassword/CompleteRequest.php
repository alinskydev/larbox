<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Base\FormRequest;
use Illuminate\Validation\Validator;
use Modules\Auth\Services\CodeService;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CompleteRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::exists('user')->withoutTrashed(),
            ],
            'code' => 'required|string',
            'new_password' => [
                'required',
                Password::defaults(),
            ],
            'new_password_confirmation' => 'same:new_password',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                $codeService = new CodeService($this->email);
                $checkedInfo = $codeService->checkCode($this->code);

                if (!$checkedInfo['is_correct']) {
                    return $validator->errors()->add('code', $checkedInfo['error']);
                }
            });
        }
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();
        $this->validatedData['password'] = Hash::make($this->new_password);
    }
}
