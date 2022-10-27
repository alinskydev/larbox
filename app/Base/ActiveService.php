<?php

namespace App\Base;

class ActiveService
{
    public function __construct(
        public Model $model,
    ) {
    }
}
