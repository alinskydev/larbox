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
        $this->model = new User([
            'role' => 'registered',
        ]);

        return parent::__construct();
    }

    public function nonLocalizedRules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_\-]+$/',
                Rule::unique($this->model->getTable(), 'username'),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique($this->model->getTable(), 'email'),
            ],
            'password' => 'required|string|max:255',
            'password_confirmation' => 'required|same:password',

            'profile.full_name' => 'required|string|max:255',
            'profile.phone' => 'string|max:255',
            'profile.image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $data['password'] = Hash::make($this->password);

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
            'username.regex' => __("Только латинские символы, цифры и (_-)"),
        ];
    }
}
