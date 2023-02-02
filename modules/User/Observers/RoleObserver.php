<?php

namespace Modules\User\Observers;

use Modules\User\Models\Role;
use Illuminate\Support\Str;
use Modules\User\Models\User;

class RoleObserver
{
    public function saving(Role $model): void
    {
        $routes = $model->routes ?? [];

        $asteriskRoutes = array_filter($routes, fn ($value) => str_ends_with($value, '.*'));

        $routes = array_filter($routes, function ($value) use ($asteriskRoutes) {
            return in_array($value, $asteriskRoutes) || !Str::is($asteriskRoutes, $value);
        });

        $model->routes = array_values($routes);
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
