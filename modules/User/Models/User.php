<?php

namespace Modules\User\Models;

use App\Base\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    use SoftDeletes;

    protected $table = 'user';

    protected $with = [
        'profile',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function (self $model) {
            if ($model->id == 1) {
                throw new \Exception(__('Данная запись не подлежит удалению'));
            }
        });
    }
}
