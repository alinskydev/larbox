<?php

namespace Modules\User\Observers;

use Modules\User\Models\AccessToken;

class AccessTokenObserver
{
    // public function created(AccessToken $model): void
    // {
    //     // Setting tokens limit

    //     $user = $model->tokenable;

    //     $ids = $user->tokens()->orderBy('id', 'DESC')->offset(3)->get()->pluck('id');
    //     $user->tokens()->whereIn('id', $ids)->delete();
    // }

    public function saving(AccessToken $model): void
    {
        $model->expires_at = now()->addWeek();
    }
}
