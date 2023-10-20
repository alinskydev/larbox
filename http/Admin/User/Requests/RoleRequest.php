<?php

namespace Http\Admin\User\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use Illuminate\Support\Arr;
use Modules\User\Helpers\RoleHelper;

class RoleRequest extends ActiveFormRequest
{
    public function __construct()
    {
        parent::__construct();

        if ($this->model->exists) {
            if ($this->model->id === 1) {
                abort(400, __('Редактирование данной записи запрещено'));
            }

            if ($this->model->id === request()->user()->role_id) {
                abort(400, __('Нельзя редактировать собственную роль'));
            }
        }
    }

    public function nonLocalizedRules(): array
    {
        return [
            'routes' => 'required|array',
            'routes.*' => 'required|string',
        ];
    }

    public function localizedRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule(
                    model: $this->model,
                    fieldIsLocalized: true,
                ),
            ],
        ];
    }

    protected function additionalValidation(): void
    {
        $availableRoutes = Arr::only(RoleHelper::routesTree(true), 'admin') ?? [];
        $availableRoutes = Arr::dot($availableRoutes);

        if (!$availableRoutes) {
            $this->validator->errors()->add('routes', __('Для данного типа права не доступны'));
            return;
        }

        foreach ($this->routes as $r) {
            if (!in_array($r, $availableRoutes)) {
                $this->validator->errors()->add('routes', __("Право ':route' недоступно", [
                    'route' => $r,
                ]));

                return;
            }
        }
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();

        $this->merge([
            'routes' => array_filter($this->routes, fn ($value) => !str_contains($value, '.*')),
        ]);
    }
}
