<?php

namespace Http\Common\Auth\Requests\ResetPassword;

use App\Http\Requests\FormRequest;
use Modules\Auth\Services\CodeService;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;

class CompleteRequest extends FormRequest
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
            'new_password' => 'required|string|min:8|max:100',
            'new_password_confirmation' => 'required|same:new_password',
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

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $data['password'] = Hash::make($this->new_password);

        return $data;
    }
}
