<?php

namespace Modules\User\Models;

use App\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends UserModel
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'user';

    protected $with = ['profile'];

    protected $hidden = [
        'email_verified_at',
        'password',
        'remember_token',
        'reset_password_code',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $model) {
            if ($model->id == 1) {
                throw new \Exception(__('Данный пользователь не подлежит удалению'));
            }
        });
    }
}
