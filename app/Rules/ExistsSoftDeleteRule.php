<?php

namespace App\Rules;

use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

use App\Models\Model;

class ExistsSoftDeleteRule extends Rule
{
    public function __construct(
        public Model $model,
        public string $foreignTable,
        public string $field = 'id',
        public ?\Closure $extraQuery = null
    ) {
    }

    public function passes($attribute, $value)
    {
        $data = Arr::undot([$attribute => $value]);

        $oldValue = $this->model->$attribute;

        $validator = Validator::make($data, [$attribute => [
            ValidationRule::exists($this->foreignTable, $this->field)->where(function (Builder $query) use ($oldValue) {
                if ($oldValue instanceof Collection) {
                    $query->where(function (Builder $subQuery) use ($oldValue) {
                        $ids = $oldValue->pluck('id')->toArray();
                        $subQuery->where('deleted_at', null)->orWhereIn($this->field, $ids);
                    });
                } else {
                    $query->where(function (Builder $subQuery) use ($oldValue) {
                        $subQuery->where('deleted_at', null)->orWhere($this->field, $oldValue);
                    });
                }

                if ($this->extraQuery) {
                    ($this->extraQuery)($query);
                }
            }),
        ]]);

        $this->errorMessage = __('rule.not_exists', ['attribute' => __("field.$attribute")]);

        return !$validator->fails();
    }
}
