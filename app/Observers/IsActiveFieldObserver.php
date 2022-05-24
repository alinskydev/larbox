<?php

namespace App\Observers;

use App\Models\Model;

class IsActiveFieldObserver
{
    public function creating(Model $model)
    {
        $model->is_active = auth()->user()->role == 'admin';
    }
}
