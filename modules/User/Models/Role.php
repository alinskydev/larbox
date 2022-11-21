<?php

namespace Modules\User\Models;

use App\Base\Model;

class Role extends Model
{
    protected $table = 'user_role';

    protected $casts = [
        'name' => 'array',
        'routes' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

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
