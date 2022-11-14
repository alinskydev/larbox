<?php

namespace App\Observers;

use App\Base\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class SlugObserver
{
    protected string $sourceField;

    public function saving(Model $model)
    {
        $sourceValue = $model->{$this->sourceField};

        if (is_array($sourceValue)) {
            $locale = app('language')->main['code'];
            $sourceValue = Arr::get($sourceValue, $locale);
        }

        $slug = Str::slug($sourceValue);

        $query = $model->query()->where('slug', $slug)->where('id', '!=', $model->id);

        if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query->withTrashed();
        }

        if ($query->count() > 0) {
            $slug .= '-' . uniqid();
        }

        $model->slug = $slug;
    }
}
