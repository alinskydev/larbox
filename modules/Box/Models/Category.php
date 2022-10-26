<?php

namespace Modules\Box\Models;

use App\Models\HierarchicalModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Category extends HierarchicalModel
{
    use SoftDeletes;
    use SeoMetaModelTrait;

    protected $table = 'box_category';

    protected $casts = [
        'name' => 'array',
    ];

    protected $appends = [
        'text',
    ];

    public function getTextAttribute()
    {
        return Arr::get($this->name, app()->getLocale());
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            $locale = app('language')->main['code'];
            $slug = Arr::get($model->name, $locale);
            $slug = Str::slug($slug);

            $model->slug = $slug;
        });
    }
}
