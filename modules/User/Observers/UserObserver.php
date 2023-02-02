<?php

namespace Modules\User\Observers;

use Modules\User\Models\User;

class UserObserver
{
    public function created(User $model): void
    {
        $model->getService()->createNewAccessToken();
    }

    public function updated(User $model): void
    {
        if ($model->wasChanged('password')) {
            $model->tokens()->delete();
            $model->getService()->createNewAccessToken();
        }
    }

    public function deleting(User $model): void
    {
        if ($model->id === 1) throw new \Exception(__('Данная запись не подлежит удалению'));
    }
}
