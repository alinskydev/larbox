<?php

namespace App\Services;

use App\Models\Model;

class ActiveService
{
    public function __construct(
        public Model $model
    ) {
    }
}
