<?php

namespace App\Observers;

use App\Models\Model;

class ActivateObserver
{
    public function creating(Model $model)
    {
        $model->is_active = auth()->user()->role_id == 1;
    }

    public function saving(Model $model)
    {
        if (auth()->user()->role != 1) $model->is_active = false;
    }
}
