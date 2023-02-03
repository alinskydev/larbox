<?php

namespace App\Rules;

use App\Base\Rule;
use App\Base\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class ExistsWithOldRule extends Rule
{
    public function __construct(
        private Model $model,
        private Builder $query,
        private ?string $pk = null,
    ) {
        $this->pk ??= $this->query->getModel()->getKeyName();
    }

    public function passes($attribute, $value): bool
    {
        $oldValue = data_get($this->model, $attribute);
        $oldValue = $oldValue instanceof Collection ? $oldValue->pluck($this->pk)->toArray() : (array)$oldValue;

        $newValue = array_diff((array)$value, $oldValue);

        if (!$newValue) return true;

        $this->query->whereIn($this->pk, $newValue);

        if ($this->query->count() < count($newValue)) {
            $attribute = preg_replace('/.*\./', '', $attribute);

            $this->errorMessage = __('validation.exists', [
                'attribute' => __("fields.$attribute"),
            ]);

            return false;
        }

        return true;
    }
}
