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
use Modules\User\Observers\UserObserver;
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

    public string $newAccessToken;

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getService(): UserService
    {
        return new UserService($this);
    }

    protected static function booted(): void
    {
        self::observe([
            UserObserver::class,
        ]);
    }
}
