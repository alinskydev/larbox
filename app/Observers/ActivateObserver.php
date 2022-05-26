<?php

namespace App\Observers;

use App\Models\Model;

class ActivateObserver
{
    public function creating(Model $model)
    {
        $model->is_active = auth()->user()->role == 'admin';
    }

    public function saving(Model $model)
    {
        if (auth()->user()->role != 'admin') $model->is_active = false;
    }
}
