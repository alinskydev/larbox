<?php

namespace App\Observers;

use App\Base\Model;

class CreatorObserver
{
    public function creating(Model $model): void
    {
        $model->creator_id = auth()->user()->id;
    }
}
