<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Base\FormRequest;
use Modules\Auth\Services\CodeService;

use Illuminate\Validation\Rule;

class VerifyCodeRequest extends FormRequest
{
    public function nonLocalizedRules()
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

    public function withValidator($validator)
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
}
