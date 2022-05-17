<?php

namespace App\Observers;

use App\Models\Model;

class CreatorIdFieldObserver
{
    public function creating(Model $model)
    {
        $model->creator_id = auth()->user()->id;
    }
}
