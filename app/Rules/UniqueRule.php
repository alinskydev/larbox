<?php

namespace App\Rules;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use App\Base\Rule;
use App\Base\Model;

class UniqueRule extends Rule
{
    public function __construct(
        private Model $model,
        private bool $fieldIsLocalized,
        private bool $showDetailedErrorMessage = true,
        private ?\Closure $extraQuery = null,
    ) {
    }

    public function passes($attribute, $value): bool
    {
        $attributeArr = explode('.', $attribute);

        if ($this->fieldIsLocalized) {
            $fieldColumn = $attributeArr[count($attributeArr) - 2];
            $fieldPath = end($attributeArr);

            $field = "$fieldColumn->>'$fieldPath'";
        } else {
            $field = end($attributeArr);
        }

        $query = $this->model->query()
            ->where(DB::raw("LOWER($field)"), mb_strtolower($value))
            ->whereKeyNot($this->model->getKey());

        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            $query->withTrashed();
        }

        if ($this->extraQuery) {
            ($this->extraQuery)($query);
        }

        $modelExists = $query->first();

        if (!$modelExists) return true;

        if ($this->showDetailedErrorMessage) {
            $this->errorMessage = __("Данное значение поля уже используется в записи ':pk'", [
                'pk' => $modelExists->getKey(),
            ]);
        } else {
            $this->errorMessage = __('validation.unique');
        }

        return false;
    }
}
