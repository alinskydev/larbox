<?php

namespace Http\Website\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Helpers\Validation\ValidationFileRulesHelper;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends ActiveFormRequest
{
    protected array $filesSavePaths = [
        'profile.image' => 'user',
    ];

    public function __construct()
    {
        if ($model = request()->user()) {
            $this->model = $model;
        }

        parent::__construct();
    }

    public function nonLocalizedRules(): array
    {
        return [
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
                'nullable',
                Password::defaults(),
            ],
            'new_password_confirmation' => 'same:new_password',

            'profile.full_name' => 'required|string|max:255',
            'profile.phone' => 'present|nullable|string|max:255',
            'profile.image' => ValidationFileRulesHelper::image(),
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
