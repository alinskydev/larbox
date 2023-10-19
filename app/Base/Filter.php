<?php

namespace App\Base;

abstract class Filter
{
    abstract public function process(QueryBuilder $query): QueryBuilder;
}
