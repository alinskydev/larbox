<?php

namespace Modules\User\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\User;
use Modules\User\Enums\UserEnums;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Helpers\FormRequestHelper;
use App\Helpers\FileHelper;

class UserRequest extends ActiveFormRequest
{
    protected array $ignoredModelFields = [
        'profile.image',
    ];
    
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
            
            'profile.full_name' => 'required|string|max:100',
            'profile.phone' => 'nullable|string|max:100',
            'profile.image' => 'nullable|file|max:1024|mimes:jpg,png,webp',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        if ($this->new_password) $data['password'] = Hash::make($this->new_password);
            echo '<pre>';
            print_r($this->files);
            echo '</pre>';
            die;

        if ($profileFiles = $this->files->get('profile')) {
            if (isset($profileFiles['image'])) {
                $data['profile']['image'] = FileHelper::upload($profileFiles['image'], 'images');
            }
        }

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_ONE_ONE => [
                'profile' => $data['profile'],
            ],
        ];

        return $data;
    }
}
