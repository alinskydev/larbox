<?php

namespace Modules\Box\Observers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Box\Models\Category;

class CategoryObserver
{
    public function saving(Category $model): void
    {
        $locale = app('language')->main['code'];

        $slug = Arr::get($model->name, $locale);
        $slug = Str::slug($slug);

        $model->slug = $slug;
    }
}
