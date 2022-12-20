<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;
use App\Rules\ExistsWithOldRule;
use App\Helpers\Validation\ValidationFileHelper;

use Modules\User\Models\Role;

class UserRequest extends ActiveFormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'role_id' => [
                'nullable',
                new ExistsWithOldRule(
                    model: $this->model,
                    relationClass: Role::class,
                ),
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
            ...$this->deleteableFileFieldsSingleValidation(
                field: 'profile.image',
                config: ValidationFileHelper::CONFIG_IMAGE,
            ),
        ];
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        if ($this->new_password) {
            $this->validatedData['password'] = Hash::make($this->new_password);
        }

        $this->model->fillRelations(
            oneToOne: [
                'profile' => $this->validatedData['profile'] ?? [],
            ],
        );
    }

    public function messages(): array
    {
        return [
            'username.regex' => __("Только латинские символы, цифры и (_-)"),
        ];
    }
}
