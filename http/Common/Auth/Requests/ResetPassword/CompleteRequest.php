<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Base\FormRequest;
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

    protected function additionalValidation(): void
    {
        $codeService = new CodeService($this->email);
        $checkedInfo = $codeService->checkCode($this->code);

        if (!$checkedInfo['is_correct']) {
            $this->validator->errors()->add('code', $checkedInfo['error']);
            return;
        }
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();
        $this->validatedData['password'] = Hash::make($this->new_password);
    }
}
