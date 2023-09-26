<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Base\FormRequest;
use Modules\Auth\Services\CodeService;
use Illuminate\Validation\Rule;

class VerifyCodeRequest extends FormRequest
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
}
