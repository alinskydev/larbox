<?php

namespace Modules\User\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;
use Modules\User\Enums\UserEnums;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Rules\ExistsSoftDeleteRule;
use App\Helpers\FormRequestHelper;

class UserRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new User()
        );
    }

    public function rules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:100',
                Rule::unique($this->model->getTable())->ignore($this->model->id),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique($this->model->getTable())->ignore($this->model->id),
            ],
            'new_password' => [
                Rule::requiredIf(!$this->model->exists),
                'string',
                'min:8',
                'max:100',
            ],
            'full_name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:100',
            'role' => [
                'required',
                Rule::in(array_keys(UserEnums::roles())),
                Rule::prohibitedIf($this->model->id == 1 && $this->role != 'admin'),
            ],

            'regions' => [
                'array',
                new ExistsSoftDeleteRule($this->model, 'region'),
            ],
            'cities' => [
                'array',
                new ExistsSoftDeleteRule($this->model, 'region_city'),
            ],
        ];
    }

    protected  function passedValidation()
    {
        parent::passedValidation();

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_MANY_MANY => [
                'regions' => $this->regions,
                'cities' => $this->cities,
            ],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        if ($this->new_password) $data['password'] = Hash::make($this->new_password);

        return $data;
    }

    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes['full_name'] = __('fields.user.full_name');

        return $attributes;
    }
}
