<?php

namespace App\Observers;

use App\Base\Model;

class CreatorObserver
{
    public function creating(Model $model)
    {
        $model->creator_id = auth()->user()->id;
    }
}
