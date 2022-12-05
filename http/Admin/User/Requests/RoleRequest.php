<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Helpers\RoleHelper;

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

    public function nonLocalizedRules(): array
    {
        return [
            'routes' => 'array',
            'routes.*' => Rule::in(RoleHelper::routesList(true)),
        ];
    }

    public function localizedRules(): array
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

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $routes = $this->validatedData['routes'] ?? [];

        $asteriskRoutes = array_filter($routes, fn ($value) => str_ends_with($value, '*'));

        foreach ($asteriskRoutes as $asteriskRoute) {
            $asteriskRoute = rtrim($asteriskRoute, '/*/');

            $routes = array_filter($routes, function ($value) use ($asteriskRoute) {
                return !str_starts_with($value, $asteriskRoute) || str_ends_with($value, '*');
            });
        }

        $this->validatedData['routes'] = array_values($routes);
    }

    public function messages(): array
    {
        return [
            'routes.*.in' => __('Маршруты обновились, перезагрузите страницу и попробуйте снова'),
        ];
    }
}
