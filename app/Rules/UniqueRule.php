<?php

namespace App\Rules;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use App\Base\Rule;
use App\Base\Model;

class UniqueRule extends Rule
{
    public function __construct(
        public Model $model,
        public bool $showPK = true,
        public ?\Closure $extraQuery = null,
    ) {
    }

    public function passes($attribute, $value): bool
    {
        $query = $this->model->query()->whereNot($this->model->getKeyName(), $this->model->getKey());

        $attribute = explode('.', $attribute);

        if (count($attribute) == 1) {
            $query->where(DB::raw("LOWER($attribute[0])"), mb_strtolower($value));
        } else {
            $fieldKey = $attribute[0];
            $fieldPath = $attribute[1];

            $query->where(DB::raw("LOWER($fieldKey->>'$fieldPath')"), mb_strtolower($value));
        }

        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            $query->withTrashed();
        }

        if ($this->extraQuery) {
            ($this->extraQuery)($query);
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
