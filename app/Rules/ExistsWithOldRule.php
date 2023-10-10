<?php

namespace App\Rules;

use App\Base\Rule;
use App\Base\Model;
use App\Base\QueryBuilder;
use Illuminate\Database\Eloquent\Collection;

class ExistsWithOldRule extends Rule
{
    public function __construct(
        private Model $model,
        private QueryBuilder $query,
        private ?string $pk = null,
        ?string $errorMessage = null,
    ) {
        $this->pk ??= $this->query->getModel()->getKeyName();
        $this->errorMessage = $errorMessage ?? __('Данная запись не существует или вам не принадлежит');
    }

    public function passes($attribute, $value): bool
    {
        $query = clone ($this->query);

        $oldValue = data_get($this->model, $attribute);
        $oldValue = $oldValue instanceof Collection ? $oldValue->pluck($this->pk)->toArray() : (array)$oldValue;

        $newValue = array_diff((array)$value, $oldValue);

        if (!$newValue) return true;

        $query->whereIn($this->pk, $newValue);

        if ($query->count() < count($newValue)) {
            return false;
        }

        return true;
    }
}
