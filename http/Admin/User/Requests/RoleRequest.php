<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Helpers\Role\AdminRoleHelper;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;

class RoleRequest extends ActiveFormRequest
{
    public function __construct()
    {
        parent::__construct();

        if ($this->model->exists && $this->model->id == 1) {
            abort(403, __('Редактирование данной записи запрещено'));
        }
    }

    public function nonLocalizedRules()
    {
        return [
            'routes' => 'array',
            'routes.*' => Rule::in((new AdminRoleHelper(true))->routes()),
        ];
    }

    public function localizedRules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule($this->model),
            ],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $routes = $data['routes'] ?? [];

        $asteriskRoutes = array_filter($routes, fn ($value) => str_ends_with($value, '*'));

        foreach ($asteriskRoutes as $asteriskRoute) {
            $asteriskRoute = rtrim($asteriskRoute, '/*/');

            $routes = array_filter($routes, function ($value) use ($asteriskRoute) {
                return !str_starts_with($value, $asteriskRoute) || str_ends_with($value, '*');
            });
        }

        $data['routes'] = array_values($routes);

        return $data;
    }

    public function messages()
    {
        return [
            'routes.*.in' => __('Маршруты обновились, перезагрузите страницу и попробуйте снова'),
        ];
    }
}
