<?php

namespace App\Observers;

use App\Base\Model;

class ActivateObserver
{
    public function creating(Model $model): void
    {
        $model->is_active = auth()->user()->role_id == 1;
    }

    public function saving(Model $model): void
    {
        if (auth()->user()->role_id != 1) $model->is_active = false;
    }
}
