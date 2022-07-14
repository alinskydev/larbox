<?php

namespace Http\Common\Auth\Requests\Auth;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\FileValidationHelper;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends ActiveFormRequest
{
    public function __construct()
    {
        $this->model = new User();
        return parent::__construct();
    }

    public function nonLocalizedRules()
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
            'profile.image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $data['password'] = Hash::make($this->new_password);
        $data['role'] = 'registered';

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_ONE_ONE => [
                'profile' => $data['profile'] ?? [],
            ],
        ];

        return $data;
    }

    public function messages()
    {
        return [
            'username.regex' => __("только латинские символы, цифры и (_-)"),
        ];
    }
}
