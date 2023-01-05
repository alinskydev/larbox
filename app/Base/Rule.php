<?php

namespace App\Base;

use Illuminate\Contracts\Validation\Rule as BaseRule;

class Rule implements BaseRule
{
    protected mixed $errorMessage = 'An error occurred';

    public function passes($attribute, $value): bool
    {
        return false;
    }

    public function message(): mixed
    {
        return $this->errorMessage;
    }
}
