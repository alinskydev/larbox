<?php

namespace App\Base;

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

    public static function caseByValue(mixed $value): self
    {
        $cases = self::cases();

        foreach ($cases as $case) {
            if ($case->value === $value) return $case;
        }

        throw new \Exception("Case doesn't exist");
    }
}
