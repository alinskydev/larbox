<?php

namespace App\Rules;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use App\Models\Model;

class UniqueRule extends Rule
{
    public function __construct(
        public Model $model,
        public bool $showPK = true,
    ) {
    }

    public function passes($attribute, $value)
    {
        $query = $this->model->newQuery()->whereNot($this->model->getKeyName(), $this->model->getKey());

        $attribute = explode('.', $attribute);

        if (count($attribute) == 1) {
            $query->where($attribute[0], $value);
        } else {
            $fieldKey = $attribute[0];
            $fieldPath = $attribute[1];

            $query->where(DB::raw("LOWER(JSON_UNQUOTE($fieldKey->'$.$fieldPath'))"), mb_strtolower($value));
        }

        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            $query->withTrashed();
        }

        $modelExists = $query->first();

        if ($modelExists) {
            $attribute = implode('.', $attribute);

            if ($this->showPK) {
                $this->errorMessage = __('Данное значение поля :attribute уже используется в записи №:pk', [
                    'attribute' => __("fields.$attribute"),
                    'pk' => $modelExists->getKey(),
                ]);
            } else {
                $this->errorMessage = __('validation.unique');
            }

            return false;
        }

        return true;
    }
}
