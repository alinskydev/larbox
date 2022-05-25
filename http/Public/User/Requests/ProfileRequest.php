<?php

namespace Http\Public\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;

use Illuminate\Validation\Rule;
use App\Rules\FileRule;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends ActiveFormRequest
{
    protected array $fileFields = [
        'profile.image',
    ];

    public function __construct()
    {
        $model = auth()->user();

        if ($model instanceof User) {
            return parent::__construct(
                model: $model
            );
        }
    }

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
            'new_password' => 'string|max:100',
            'new_password_confirmation' => [
                Rule::requiredIf($this->new_password !== null),
                'same:new_password',
            ],

            'profile.full_name' => 'required|string|max:100',
            'profile.phone' => 'nullable|string|max:100',
            'profile.image' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],
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
                'profile' => $data['profile'],
            ],
        ];

        return $data;
    }

    public function messages()
    {
        return [
            'username.regex' => __('rule.regex.latin_numbers_extra:_-'),
        ];
    }
}
