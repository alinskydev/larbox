<?php

namespace App\Search;

use Illuminate\Database\Eloquent\Builder;

class SearchSort
{
    public function __construct(
        private Builder $query,
        private array $sortings,
        private array $params,
    ) {
    }

    public function process(): void
    {
        foreach ($this->params as $param) {
            if (str_starts_with($param, '-')) {
                $direction = 'DESC';
                $param = substr($param, 1);
            } else {
                $direction = 'ASC';
            }

            if (!isset($this->sortings[$param])) continue;

            $sortType = $this->sortings[$param]->value;

            $this->$sortType(
                field: $param,
                direction: $direction,
            );
        }
    }

    private function sortRaw(string $field, string $direction): void
    {
        $this->query->orderBy($field, $direction);
    }

    private function sortLocalized(string $field, string $direction): void
    {
        $locale = app()->getLocale();
        $this->query->orderBy("$field->$locale", $direction);
    }
}
