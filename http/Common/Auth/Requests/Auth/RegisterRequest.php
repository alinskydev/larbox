<?php

namespace Http\Common\Auth\Requests\Auth;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Helpers\Validation\ValidationFileRulesHelper;
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
            'password' => [
                'required',
                Password::defaults(),
            ],
            'password_confirmation' => 'same:password',

            'profile.full_name' => 'required|string|max:255',
            'profile.phone' => 'string|max:255',
            'profile.image' => ValidationFileRulesHelper::image(),
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
