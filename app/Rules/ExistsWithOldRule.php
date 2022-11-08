<?php

namespace App\Rules;

use App\Base\Rule;
use App\Base\Model;

class ExistsWithOldRule extends Rule
{
    public function __construct(
        public Model $model,
        public string $relationClass,
        public string $oldValuePath,
        public string $relationField = 'id',
        public ?\Closure $extraQuery = null,
    ) {
    }

    public function passes($attribute, $value)
    {
        $oldValue = data_get($this->model, $this->oldValuePath);

        if ($value == $oldValue) return true;

        $query = $this->relationClass::query();

        if (is_array($oldValue)) {
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
            $this->errorMessage = __(':attribute с данным значением не существует', [
                'attribute' => __("fields.$attribute"),
            ]);

            return false;
        }

        return true;
    }
}
