<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Enums\UserEnums;

use Illuminate\Validation\Rule;
use App\Helpers\FormRequestHelper;
use Illuminate\Support\Facades\Hash;

class UserRequest extends ActiveFormRequest
{
    protected array $ignoredModelUpdateFields = [
        'profile.image',
    ];

    public function rules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9_\-]+$/',
                Rule::unique($this->model->getTable())->ignore($this->model->id),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique($this->model->getTable())->ignore($this->model->id),
            ],
            'role' => [
                'required',
                Rule::in(array_keys(UserEnums::roles())),
                Rule::prohibitedIf($this->model->id == 1 && $this->role != 'admin'),
            ],
            'new_password' => [
                Rule::requiredIf(!$this->model->exists),
                'string',
                'min:8',
                'max:100',
            ],
            'new_password_confirmation' => [
                Rule::requiredIf($this->new_password !== null),
                'same:new_password',
            ],

            'profile.full_name' => 'required|string|max:100',
            'profile.phone' => 'nullable|string|max:100',
            'profile.image' => FormRequestHelper::imageRules(),
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        if ($this->new_password) {
            $data['password'] = Hash::make($this->new_password);
        }

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
            'username.regex' => __("Только латинские символы, цифры и ('_', '-')"),
        ];
    }
}
