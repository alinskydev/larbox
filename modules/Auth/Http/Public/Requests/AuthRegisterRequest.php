<?php

namespace Modules\Auth\Http\Public\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;

use Illuminate\Validation\Rule;
use App\Rules\FileRule;
use Illuminate\Support\Facades\Hash;

class AuthRegisterRequest extends ActiveFormRequest
{
    protected array $fileFields = [
        'profile.image' => 'images',
    ];

    public function __construct()
    {
        return parent::__construct(
            model: new User()
        );
    }

    public function rules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9_\-]+$/',
                Rule::unique('user', 'username'),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('user', 'email'),
            ],
            'new_password' => 'required|string|max:100',
            'new_password_confirmation' => 'required|same:new_password',

            'profile.full_name' => 'required|string|max:100',
            'profile.phone' => 'nullable|string|max:100',
            'profile.image' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $data['password'] = Hash::make($this->new_password);
        $data['role'] = 'registered';

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_ONE_ONE => [
                'profile' => $data['profile'],
            ],
        ];

        return $data;
    }

    public function messages()
    {
        return [
            'username.regex' => __('rule.regex.latin_numbers_extra:_-'),
        ];
    }
}
