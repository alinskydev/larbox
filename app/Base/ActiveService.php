<?php

namespace App\Base;

class ActiveService
{
    public function __construct(protected Model $model)
    {
    }
}
