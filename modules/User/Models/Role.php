<?php

namespace Modules\User\Models;

use App\Base\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $table = 'user_role';

    protected $casts = [
        'name' => 'array',
        'routes' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (self $model) {
            $routes = $model->routes ?? [];

            $asteriskRoutes = array_filter($routes, fn ($value) => str_ends_with($value, '.*'));

            $routes = array_filter($routes, function ($value) use ($asteriskRoutes) {
                return in_array($value, $asteriskRoutes) || !Str::is($asteriskRoutes, $value);
            });

            $model->routes = array_values($routes);
        });

        static::deleting(function (self $model) {
            if ($model->id == 1) throw new \Exception(__('Данная запись не подлежит удалению'));

            $user = User::query()->where('role_id', $model->id)->first();

            if ($user) {
                throw new \Exception(__('Роль №:role не подлежит удалению, так как она привязана к пользователю №:user', [
                    'role' => $model->id,
                    'user' => $user->id,
                ]));
            }
        });
    }
}
