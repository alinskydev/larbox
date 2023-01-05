<?php

namespace Modules\User\Models;

use Laravel\Sanctum\PersonalAccessToken;
use Modules\User\Observers\AccessTokenObserver;

class AccessToken extends PersonalAccessToken
{
    protected $table = 'user_access_token';

    protected static function booted(): void
    {
        self::observe([
            AccessTokenObserver::class,
        ]);
    }
}
