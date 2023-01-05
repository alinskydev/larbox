<?php

namespace Modules\User\Models;

use App\Base\Model;
use Modules\User\Observers\RoleObserver;

class Role extends Model
{
    protected $table = 'user_role';

    protected $casts = [
        'name' => 'array',
        'routes' => 'array',
    ];

    protected static function booted(): void
    {
        self::observe([
            RoleObserver::class,
        ]);
    }
}
