<?php

namespace Http\Common\Auth\Requests\Auth;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\ValidationFileHelper;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends ActiveFormRequest
{
    public function __construct()
    {
        $this->model = new User();
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
                Rule::unique($this->model->getTable()),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique($this->model->getTable()),
            ],
            'password' => 'required|string|max:255',
            'password_confirmation' => 'required|same:password',

            'profile.full_name' => 'required|string|max:255',
            'profile.phone' => 'string|max:255',
            'profile.image' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_IMAGE),
        ];
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $this->validatedData['password'] = Hash::make($this->password);

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
