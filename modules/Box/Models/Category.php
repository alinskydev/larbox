<?php

namespace Modules\Box\Models;

use App\Hierarchy\HierarchyModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Category extends HierarchyModel
{
    use SoftDeletes;
    use SeoMetaModelTrait;

    protected $table = 'box_category';

    protected $casts = [
        'name' => 'array',
    ];

    public function getTextAttribute()
    {
        return Arr::get($this->name, app()->getLocale());
    }

    public function boxes()
    {
        return $this->belongsToMany(Box::class, 'box_category_ref', 'category_id', 'box_id')->withTrashed();
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            $locale = app('language')->main['code'];
            $slug = Arr::get($model->name, $locale);
            $slug = Str::slug($slug);

            if ($model->exists) {
                $modelWithSameSlug = $model->siblings()->where('slug', $slug)->first();
            } else {
                $modelWithSameSlug = static::query()->where('slug', $slug)->first();
            }

            if ($modelWithSameSlug) {
                $slug .= '-' . uniqid();
            }

            $model->slug = $slug;
        });
    }
}
