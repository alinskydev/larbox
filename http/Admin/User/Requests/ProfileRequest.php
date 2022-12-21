<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;

use Illuminate\Validation\Rule;
use App\Helpers\Validation\ValidationFileHelper;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends ActiveFormRequest
{
    public function __construct()
    {
        if ($model = auth()->user()) {
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
            'new_password' => 'present|nullable|string|min:8,max:255',
            'new_password_confirmation' => [
                Rule::requiredIf(strlen($this->new_password) > 0),
                'same:new_password',
            ],

            'profile.full_name' => 'required|string|max:255',
            'profile.phone' => 'present|nullable|string|max:255',
            'profile.image' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_IMAGE),
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
