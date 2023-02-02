<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Rules\ExistsWithOldRule;
use App\Helpers\Validation\ValidationFileRulesHelper;

use Modules\User\Models\Role;

class UserRequest extends ActiveFormRequest
{
    protected array $filesSavePaths = [
        'profile.image' => 'user',
    ];

    public function nonLocalizedRules(): array
    {
        return [
            'role_id' => [
                'nullable',
                new ExistsWithOldRule(
                    model: $this->model,
                    relationClass: Role::class,
                ),
                Rule::prohibitedIf($this->model->id === 1),
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
                Password::defaults(),
            ],
            'new_password_confirmation' => 'same:new_password',

            'profile.full_name' => 'required|string|max:255',
            'profile.phone' => 'present|nullable|string|max:255',
            ...$this->deleteableFileFieldsSingleValidation(
                field: 'profile.image',
                rules: ValidationFileRulesHelper::image(),
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
