<?php

namespace App\Services;

use App\Models\Model;

class ModelService
{
    public function __construct(
        public Model $model
    ) {
    }
}
