<?php

namespace App\Observers;

use App\Base\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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

        $modelWithSameSlug = $model->query()
            ->where('slug', $slug)
            ->where('id', '!=', $model->id)
            ->first();

        if ($modelWithSameSlug) {
            $slug .= '-' . uniqid();
        }

        $model->slug = $slug;
    }
}
