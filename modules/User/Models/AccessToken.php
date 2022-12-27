<?php

namespace Modules\User\Models;

use Laravel\Sanctum\PersonalAccessToken;

class AccessToken extends PersonalAccessToken
{
    protected $table = 'user_access_token';

    /**
     * Setting tokens limit
     */
    // protected static function boot(): void
    // {
    //     parent::boot();

    //     static::created(function (self $model) {
    //         $user = $model->tokenable;

    //         $ids = $user->tokens()->orderBy('id', 'DESC')->offset(3)->get()->pluck('id');
    //         $user->tokens()->whereIn('id', $ids)->delete();
    //     });
    // }
}
