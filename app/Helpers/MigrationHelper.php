<?php

namespace App\Helpers;

use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;

class MigrationHelper
{
    public static function likeIndex(Blueprint $table, string $field): void
    {
        $name = $table->getTable() . '_' . $field . '_index';
        $table->rawIndex(new Expression("LOWER($field) text_pattern_ops"), $name);
    }

    public static function localizedLikeIndex(Blueprint $table, string $field): void
    {
        $locales = array_keys(config('larbox.languages'));

        foreach ($locales as $locale) {
            $name = $table->getTable() . '_' . $field . '_localized_' . $locale . '_index';
            $table->rawIndex(new Expression("LOWER($field->>'$locale') text_pattern_ops"), $name);
        }
    }
}
