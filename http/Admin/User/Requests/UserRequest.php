<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;
use App\Rules\ExistsWithOldRule;
use App\Helpers\Validation\FileValidationHelper;

use Modules\User\Models\Role;

class UserRequest extends ActiveFormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'role_id' => [
                'nullable',
                new ExistsWithOldRule($this->model, Role::class, 'role_id'),
                Rule::prohibitedIf($this->model->id == 1),
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_\-]+$/',
                Rule::unique($this->model->getTable())->ignore($this->model->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique($this->model->getTable())->ignore($this->model->id),
            ],
            'new_password' => [
                Rule::requiredIf(!$this->model->exists),
                'nullable',
                'string',
                'min:8',
                'max:255',
            ],
            'new_password_confirmation' => [
                Rule::requiredIf(strlen($this->new_password) > 0),
                'same:new_password',
            ],

            'profile.full_name' => 'required|string|max:255',
            'profile.phone' => 'nullable|string|max:255',
            'profile.image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }

    public function validated($key = null, $default = null): array
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

    public function messages(): array
    {
        return [
            'username.regex' => __("Только латинские символы, цифры и (_-)"),
        ];
    }
}
