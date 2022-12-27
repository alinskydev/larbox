<?php

namespace Modules\User\Models;

use App\Base\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Services\UserService;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasApiTokens;
    use SoftDeletes;

    protected $table = 'user';

    protected $with = [
        'profile',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public ?string $newAccessToken = null;

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

        static::created(function (self $model) {
            $service = new UserService($model);
            $service->assignNewAccessToken();
        });

        static::updated(function (self $model) {
            if ($model->wasChanged('password')) {
                $model->tokens()->delete();

                $service = new UserService($model);
                $service->assignNewAccessToken();
            }
        });

        static::deleting(function (self $model) {
            if ($model->id == 1) {
                throw new \Exception(__('Данная запись не подлежит удалению'));
            }
        });
    }
}
