<?php

namespace App\Base;

use Illuminate\Support\Arr;

trait EnumTrait
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function pluck(): array
    {
        return Arr::pluck(self::cases(), 'value', 'name');
    }

    public static function caseByValue(mixed $value): self
    {
        $cases = self::cases();

        foreach ($cases as $case) {
            if ($case->value === $value) return $case;
        }

        throw new \Exception("Case doesn't exist");
    }
}
