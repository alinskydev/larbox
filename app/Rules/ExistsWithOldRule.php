<?php

namespace App\Rules;

use App\Base\Rule;
use App\Base\Model;
use Illuminate\Database\Eloquent\Collection;

class ExistsWithOldRule extends Rule
{
    public function __construct(
        private Model $model,
        private string $relationClass,
        private string $relationField = 'id',
        private ?\Closure $extraQuery = null,
    ) {
    }

    public function passes($attribute, $value): bool
    {
        $oldValue = data_get($this->model, $attribute);

        if ($value == $oldValue) return true;

        $query = $this->relationClass::query();

        if ($oldValue instanceof Collection) {
            $oldValue = data_get($oldValue, "*.$this->relationField");

            $value = array_diff($value, $oldValue);
            $query->whereIn($this->relationField, $value);
        } else {
            $query->where($this->relationField, $value);
        }

        if ($this->extraQuery) {
            ($this->extraQuery)($query);
        }

        $relationsCount = $query->count();

        if ($relationsCount < count((array)$value)) {
            $attribute = preg_replace('/.*\./', '', $attribute);

            $this->errorMessage = __(':attribute с данным значением не существует', [
                'attribute' => __("fields.$attribute"),
            ]);

            return false;
        }

        return true;
    }
}
