<?php

namespace Modules\User\Observers;

use Modules\User\Models\Role;
use Modules\User\Helpers\RoleHelper;
use Modules\User\Models\User;

class RoleObserver
{
    public function saving(Role $model): void
    {
        $routes = $model->routes ?? [];
        $availableRoutes = RoleHelper::routesList(false);

        $routeGroups = RoleHelper::groupRoutesByCount($routes);
        $availableRouteGroups = RoleHelper::groupRoutesByCount($availableRoutes);

        krsort($routeGroups);

        foreach ($routeGroups as $group => $quantity) {
            if ($quantity === $availableRouteGroups[$group]) {
                $routes = array_filter($routes, fn ($value) => !str_starts_with($value, $group));
                $routes[] = "$group.*";
            }
        }

        $routes = array_values($routes);
        sort($routes);

        $model->routes = $routes;
    }

    public function deleting(Role $model): void
    {
        if ($model->id === 1) throw new \Exception(__('Данная запись не подлежит удалению'));

        $user = User::query()->where('role_id', $model->id)->first();

        if ($user) {
            throw new \Exception(__('Роль №:role не подлежит удалению, так как она привязана к пользователю №:user', [
                'role' => $model->id,
                'user' => $user->id,
            ]));
        }
    }
}
