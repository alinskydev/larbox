<?php

namespace Modules\Auth\Observers;

use Modules\Auth\Models\Code;

class CodeObserver
{
    public function saved(Code $model): void
    {
        if (!$model->attempts_left) $model->delete();
    }
}
