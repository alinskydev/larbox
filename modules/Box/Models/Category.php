<?php

namespace Modules\Box\Models;

use App\Hierarchy\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Category extends Model
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

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            $locale = app('language')->main['code'];
            $slug = Arr::get($model->name, $locale);
            $slug = Str::slug($slug);

            $modelWithSameSlug = $model->query()
                ->where('slug', $slug)
                ->where('id', '!=', $model->id)
                ->first();

            if ($modelWithSameSlug) {
                $slug .= '-' . uniqid();
            }

            $model->slug = $slug;
        });
    }
}
